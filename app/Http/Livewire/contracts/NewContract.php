<?php

namespace App\Http\Livewire\Contracts;

use App\Http\Controllers\PdfController;
use App\Models\AllowedTypes;
use App\Models\Attachmentdocuments;
use App\Models\Contracts;
use App\Models\Documents;
use App\Models\Rols;
use App\Models\Templates;
use App\Models\Trackings;
use App\Rules\NotInArray;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class NewContract extends Component {
    use WithFileUploads;

    public $template, $template_id, $content;
    public $list = [];
    public $participantes = [];
    public $rols = [];
    public $attachments = [];
    public $types = [];
    public $listVars = [];

    protected $listeners = ['changed_var_list','renderhtml'];

    protected $rules = [
        'participantes.*.nombre' => 'required|string|max:100',
        'participantes.*.correo' => 'required|string|email',
        'participantes.*.rol' => 'required|exists:rols,id',
        'participantes.*.titulo' => 'required|string|max:100',
        'participantes.*.status' => 'required|string',
        'list.*.value' => 'required|string|max:100',
        'attachments.*.nombre' => 'required|string|max:100',
        'attachments.*.allowed_types_id' => 'required|exists:allowed_types,id',
        'content' => 'required|string|min:20',
    ];
    protected $messages = [
        'content.min' => 'el contenido debe ser minimo 20 caracteres',
        'content.required' => 'falta editar el documento',
        'list.*.value.max'  => 'el contenido maximo 100 caracteres',
        'list.*.value'  => 'falta diligenciar  variables',
        'list.*.value.min'  => 'el contenido de la variable minimo es 3 caracteres',
                 
    ];
    
    public function mount($id) {
        $this->list = [];
        $this->participantes = [];
        $this->template_id = $id;
        $this->template = Templates::find($id);
        $this->attachments = [];
        $this->types = AllowedTypes::all();
        $this->listVars = json_decode($this->template->vars);
        foreach (json_decode($this->template->vars) as $vars) {
            $this->list[] = [
                'key' => $vars,
                'value' => null
            ];
        }
        $this->content = ($this->template->html);
        $this->baseContent = ($this->template->html);
        $this->nuevo_participante();
        $this->rols = Rols::all();
    }

    public function render() {
        $this->renderhtml();
        return view('livewire.contracts.new-contract');
    }

    public function renderhtml() {
        $main = $this->baseContent;
        foreach ($this->list as $value) {
            if($value['value'] != null) {
                $main = Str::replace($value['key'], $value['value'], $main);
            }
        }
        $this->content = $main;
    }

    // listener para actualizar lista de variables
    public function changed_var_list($list, $type) {
        if($type) {
            $this->list[] = [
                'key' => $list,
                'value' => null
            ];
            $this->listVars[] = $list;
        } else {
            $this->list = array_filter($this->list, function ($item) use ($list){
                return $item["key"] != $list;
            });
            $this->list = array_filter($this->list, function ($item) use ($list){
                return $item != $list;
            });
        }
    }

    public function nuevo_participante() {
        if(count($this->participantes) < 5) {
            $this->participantes[] = [
                'nombre' => '',
                'correo' => '',
                'rol' => '',
                'titulo' => '',
                'status' => 'Pendiente',
                'signed' => false
            ];
        }
    }

    public function remover_participante($key) {
        if(count($this->participantes) > 1) {
            unset($this->participantes[$key]);
            $this->participantes = array_values($this->participantes);
        }
    }

    public function add_anexo() {
        $this->attachments[] = [
            'nombre' => '',
            'allowed_types_id'  => 1,
            'comment' => ''
        ];
    }

    public function remover_anexo($keyy) {
        unset($this->attachments[$keyy]);
        $this->attachments = array_values($this->attachments);
    }

    public function save() {
        $this->validate();
        DB::beginTransaction();
        try {
            $pdf = new PdfController($this->content);
            
            $document = new Documents;
            $document->company_pdf = $pdf->pdfBase64;
            $document->save();

            $contract = new Contracts;
            $contract->status = json_encode(['status' => 'Borrador']);
            $contract->participants = json_encode(array_values($this->participantes));
            $contract->document_name = $this->template->name;
            $contract->document_id = $document->id;
            $contract->owner =  Auth::user()->id;
            $contract->owner_status = json_encode(['signed' => false, 'nombre' => Auth::user()->name, 'titulo' => '',  "status" => "Pendiente por Firmar"]);
            $contract->sign_html = '<table id="tablesignatures" cellspacing="0" style="width: 100%; text-align: center; font-size: 10px;font-family: arial" class="header"><colgroup><col style="width: 50%;"><col style="width: 50%;"><tr><td></td><td></td></tr></table>';
            $contract->vars = json_encode($this->list);
            $contract->html = $this->content;
            $contract->save();
            
            $track = new Trackings;
            $track->owner = Auth::user()->name;
            $track->contract_id = $contract->id;
            $track->type = '';
            $track->value = 'Ha creado el contrato';
            $track->save();

            $this->setattachments($contract->id);

            DB::commit();
            $this->mount($this->template_id);
            $this->emit('save_success', 'Contrato creado exitosamente y enviado a Borradores');
            return redirect()->to('/contracts');
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('error', $e->getMessage());
        };
    }
    
    private function setattachments($contractid) {
        if(count($this->attachments) > 0) {
            foreach ($this->participantes as $participante) {
                foreach ($this->attachments as $anex) {
                    $anexo = new Attachmentdocuments();
                    $anexo->contract_id = $contractid;
                    $anexo->allowed_types_id = $anex['allowed_types_id'];
                    $anexo->attachmentdocument_name = $anex['nombre'];
                    $anexo->attachmentdocument_document = null;
                    $anexo->participant = $participante['correo'];
                    $anexo->comment = $anex['comment'];
                    $anexo->status = false;
                    $anexo->save();
                }
            }
        }
    }
}
