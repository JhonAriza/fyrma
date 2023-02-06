<?php

namespace App\Http\Livewire\Contracts;

use App\Models\Attachmentdocuments;
use App\Models\Contracts;
use App\Models\Logs;
use App\Models\Trackings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class SignContract extends Component {
    
    use WithFileUploads; 

    public $signature, $ip, $id_participant, $contract_id;
    public $states = ['Aceptado','Rechazar'];
    public $status = null;
    public $message;
    public $signaturestable;
    public $annexes = [];
    public $filesAnnexes = [];
    public $show_comments = false;
    public $owner_contract;

    protected $listeners = ['save_signature','parent_comments','hide_comments','save','validatesignature'];

    protected $rules = [
        'status' => 'required',
        'signature' => 'required_if:status,=,Aceptado',
        'message' => 'required_if:status,=,Rechazar',
        'annexes.attachmentdocument_document' => 'min:5'
    ];
    
    public function mount($id, $user, $ip, $id_participant) {
        $this->email = $user;
        $this->ip = $ip;
        $this->id_participant = $id_participant;
        $this->contract_id = $id;
        $this->contract = Contracts::find($this->contract_id);
    }

    public function render() {
       
        $document = Contracts::find($this->contract_id);
        $mystate =(json_decode($document->participants)[$this->id_participant]);
        $this->annexes = Attachmentdocuments::MyAttachments($this->contract_id, $mystate->correo);
        $this->signature = Auth::user()->signature;
        return view('livewire.contracts.sign-contract', compact('document','mystate'));
    }
    
    public function save_signature() {
        $this->render();
    }
    
    public function validatesignature() {
        $this->validate();
        $this->emit('generatesignature');
    }

    public function newsignature() {
        $this->emit('newsignature');
    }

    public function save () {
        DB::beginTransaction();
        try {
         
            $contract = Contracts::find($this->contract_id);
            $participants = json_decode($contract->participants);

            if($this->status === "Aceptado") {
                $participants[$this->id_participant]->status = $this->status;
                $participants[$this->id_participant]->signed = true;
                $participants[$this->id_participant]->nombre = Auth::user()->name;
                $this->signaturestable = Str::replace('[firma]',Auth::user()->signature->signature, $this->signaturestable);
                $this->signaturestable = Str::replace('[nombre]',Auth::user()->name, $this->signaturestable);
                $this->signaturestable = Str::replace('[titulo]',$participants[$this->id_participant]->titulo, $this->signaturestable);
                $contract->sign_html = $this->signaturestable;
                $contract->participants = json_encode($participants, true);
                $contract->save();
                
                $track = new Trackings;
                $track->contract_id = $this->contract_id;
                $track->owner = Auth::user()->name;
                $track->type = 'ha aceptado y firmado';
                $track->value = 'el contrato';
                $track->save();

                $log = new Logs;
                $log->contract_id = $this->contract_id;
                $log->type = 'signed contract';
                $log->value = json_encode(['IP' => $this->ip, 'DATE' => Carbon::now()]);
                $log->save();

                $allcomplete = true;
                foreach (json_decode($contract->participants) as $value) {
                    if($allcomplete && !$value->signed) {
                        $allcomplete = false;
                    }
                }
                if($allcomplete) {
                    $contract->status = json_encode(['status' => 'En Revision']);
                    $contract->save();
                }


                $this->emit('save_success', 'Contrato Aceptado y Firmado');
            } else if($this->status === "Rechazar") {
                $participants[$this->id_participant]->nombre = Auth::user()->name;
                $participants[$this->id_participant]->status = $this->status;
                $contract->participants = json_encode($participants, true);
                $contract->status = json_encode(['status' => 'Rechazado']);
                $contract->save();

                $track = new Trackings;
                $track->contract_id = $this->contract_id;
                $track->owner = Auth::user()->name;
                $track->type = 'ha rechazado';
                $track->value = 'el contrato';
                $track->save();

                $track = new Trackings;
                $track->contract_id = $this->contract_id;
                $track->owner = Auth::user()->name;
                $track->type = 'ha comentado';
                $track->value = $this->message;
                $track->save();

                $log = new Logs;
                $log->contract_id = $this->contract_id;
                $log->type = 'rejected contract';
                $log->value = json_encode(['IP' => $this->ip, 'DATE' => Carbon::now()]);
                $log->save();
            }

            $this->emit('showhtml', $this->contract_id);
            DB::commit();
            $this->render();
        } catch(\Exception $e){
            DB::rollBack();
            $this->addError('error', $e->getMessage());
            $this->errors = $e->getMessage();
        }
    }

    public function parent_comments($block, $contract_id) {
        $this->show_comments = true;
        $this->emit('comments', $block, $contract_id);
    }

    public function hide_comments() {
        $this->reset('show_comments');
    }
}
