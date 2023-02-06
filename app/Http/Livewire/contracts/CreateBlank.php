<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Http\Controllers\PdfController;
use App\Models\AllowedTypes;
use App\Models\Attachmentdocuments;
use App\Models\Contracts;
use App\Models\Documents;
use App\Models\Rols;
use App\Models\Trackings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateBlank extends Component { 
    public $name;
    public $newVar;
    public $name_Document_blank;
    public $template, $template_id, $content, $baseContent;
    public $list = [];
    public $participantes = [];
    public $rols = [];
    public $annexes = [];
    public $types = [];
    public $listVars = [];

    public function render() {
        return view('livewire.contracts.create-blank');
    }

    protected $listeners = ['changed_var_list','renderhtml'];

    protected $rules = [
        'list.*.value' => 'required|string|max:150|min:2',
        'annexes.*.nombre' => 'required|string|max:100',
        'annexes.*.allowed_types_id' => 'required|exists:allowed_types,id',
        'content' => 'required|string|min:20'
    ];
    protected $messages = [
        'content.min' => 'El  contenido debe ser minimo 20 caracteres',
        'content.required' => 'falta editar el documento',
        'list.*.value.required'  => 'Requerido : contenido maximo 250 caracteres',
        'list.*.value.min'  => 'Requerido : contenido minimo 2 caracteres'
    ];
   
    public function mount() {
        $this->list = [];
        $this->participantes = [];
        $this->annexes = [];
        $this->types = AllowedTypes::all();
        $this->nuevo_participante();
        $this->rols = Rols::all();
    }
 
// no se puede borrar por q es la variable q  emite desde el editor
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
    public function parent_comments($block, $contract_id) {
        $this->show_comments = true;
        $this->emit('comments', $block, $contract_id);
    }
    public function hide_comments() {
        $this->reset('show_comments');
    }
    
    public function add_anexo() {
        $this->annexes[] = [
            'nombre' => '',
            'allowed_types_id'  => 1,
            'comment' => ''
        ];
    }

    public function remover_anexo($keyy) {
        unset($this->annexes[$keyy]);
        $this->annexes = array_values($this->annexes);
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
            $contract->document_name = $this->name_Document_blank;
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
 

            $this->setAnnexes($contract->id);
            DB::commit();
            $this->mount($this->template_id);
            $this->emit('save_success', 'Contrato creado exitosamente y enviado a Borradores');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('error', $e->getMessage());
        };
    }
 
    private function setAnnexes($contractid) {
        if(count($this->annexes) > 0) {
            foreach ($this->participantes as $participante) {
                foreach ($this->annexes as $anex) {
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

