<?php

namespace App\Http\Livewire\Contracts;

use App\Http\Controllers\NotificationsController;
use App\Models\AllowedTypes;
use App\Models\Attachmentdocuments;
use App\Models\Contracts;
use App\Models\Rols;
use App\Models\Shields;
use App\Models\Trackings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;


class StatusContract extends Component {
    public $contract_id, $rols, $html, $contract, $status;
    public $participantes;
    public $comentarios = [];
    public $show_comments = false;
    public $signature;
    public $shields;
    public $signaturestable;
    public $selectedShields = [];
    public $signtogenerate = false;
    public $miparticipacion;
    public $allowedTypes = [];
    public $owner_contract;

    protected $rules = [
        'participantes.*.nombre' => 'required|string|max:50',
        'participantes.*.correo' => 'required|string|email',
        'participantes.*.rol' => 'required|exists:rols,id',
        'participantes.*.titulo' => 'required|string|max:50',
        'selectedShields.0' => 'required|in:1',
        'signtogenerate' => 'boolean',
       // 'signature' => 'required_if:signtogenerate,true',
        'miparticipacion' => 'required_if:signtogenerate,true',
        'attachmentBorrador.*.attachmentdocument_name' => 'required|string|max:25',
    ];

    protected $messages = [   
        'selectedShields.0.required' => 'La firma es Obligatoria'
    ];
    protected $listeners = ['save_signature', 'hide_comments', 'parent_comments','signtogenerate','validatesignature'];

    public function mount($id) {
        $this->contract_id = $id;
        $this->contract = Contracts::find($this->contract_id);
        $this->status = (json_decode($this->contract->status)->status == 'Borrador') ? false : true;
        $this->participantes = array_values(json_decode($this->contract->participants, true));
        $this->rols = Rols::all();
        $this->signature = Auth::user()->signature;
        $this->allowedTypes = AllowedTypes::all();
        $this->attachmentBorrador = Attachmentdocuments::AttachmentsGroup($this->contract_id);    
    }

    public function render() {
        if((json_decode($this->contract->status)->status == 'Borrador')) {
            return view('livewire.contracts.status-borrador');
        } else {
            return view('livewire.contracts.status-pendiente');
        }
    }
    // se agrega para que deje crear la firma en la parte
    public function save_signature() {
        $this->render();
    }
    public function newsignature() {
        $this->emit('newsignature');
    }
    public function parent_comments($block, $contract_id) {
        $this->show_comments = true;
        $this->emit('comments', $block, $contract_id);
    }
    public function hide_comments() {
        $this->reset('show_comments');
    }
    public function notificateContract() {
        $this->validate();
        DB::beginTransaction();
        try {
            $this->contract->status = json_encode(['status' => 'Pendiente Por Firmar'], true);
            $this->contract->shields = json_encode($this->selectedShields, true);

            $notification = new NotificationsController($this->participantes);
            $notification->notificationNewContract($this->contract, Auth::user());

            $this->contract->participants = json_encode(array_values($this->participantes));
            $this->contract->save();
            $this->attachmentNotificado();
            $this->emit('save_success', 'Contrato Notificado a sus partes');
            $this->emit('showhtml', $this->contract_id);
            $this->mount($this->contract_id);
            $this->render();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('error', $e->getMessage());
        };
    }

    public function nuevo_participante() {
        $this->participantes[] = [
            'nombre' => '',
            'correo' => '',
            'rol' => '',
            'titulo' => '',
            'status' => 'Pendiente',
            "signed" => false
        ];
    }
    
    public function validatesignature() {
        $this->validateOnly('signature');
        $this->validateOnly('miparticipacion');
        $this->emit('generatesignature');
    }
    
    public function remover_participante($key) {
        unset($this->participantes[$key]);
        $this->participantes = array_values($this->participantes);
    }

    //end borrador function
    public function signtogenerate() {
        DB::beginTransaction();
        try {
            $status = json_decode($this->contract->owner_status);
            $status->titulo = $this->miparticipacion;
            $status->signed = true;
            $this->contract->owner_status = json_encode($status);
            $this->signaturestable = Str::replace('[firma]',Auth::user()->signature->signature, $this->signaturestable);
            $this->signaturestable = Str::replace('[nombre]',Auth::user()->name, $this->signaturestable);
            $this->signaturestable = Str::replace('[titulo]',$this->miparticipacion, $this->signaturestable);
            $this->contract->sign_html = $this->signaturestable;
            $this->contract->save();

            $track = new Trackings();
            $track->contract_id = $this->contract_id;
            $track->owner = Auth::user()->name;
            $track->type = 'ha firmado';
            $track->value = 'el contrato';
            $track->save();

            $this->emit('save_success', 'Contrato Firmado Exitosamente');
            $this->emit('showhtml', $this->contract_id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('error', $e->getMessage());
        };
    }

    public function remover_anexo($key) {
        unset($this->attachmentBorrador[$key]);
        $this->attachmentBorrador = array_values($this->attachmentBorrador);
    }

    public function nuevo_anexo() {
        $this->attachmentBorrador[] = [
            'attachmentdocument_name' => '',
            'allowed_types_id'  => 1,
            'comment' => ''
        ];
    }

    private function attachmentNotificado() {
        Attachmentdocuments::where('contract_id', $this->contract_id)->delete();
        if(count($this->attachmentBorrador) > 0) {
            foreach ($this->participantes as $participante) {
                foreach ($this->attachmentBorrador as $attachment) {
                    $attachmentNotificado = new Attachmentdocuments();
                    $attachmentNotificado->contract_id = $this->contract_id;
                    $attachmentNotificado->allowed_types_id = $attachment['allowed_types_id'];
                    $attachmentNotificado->attachmentdocument_name = $attachment['attachmentdocument_name'];
                    $attachmentNotificado->attachmentdocument_document = '';
                    $attachmentNotificado->participant = $participante['correo'];
                    $attachmentNotificado->comment = $attachment['comment'];
                    $attachmentNotificado->status = false;
                    $attachmentNotificado->save();
                }
            }
        }
    }
}
