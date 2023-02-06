<?php

namespace App\Http\Livewire\Received;

use App\Models\Attachmentdocuments;
use App\Models\Contracts;
use App\Models\Rols;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowDocument extends Component {

    public $contract_id, $ip, $attachmentsExists, $urlSign;

    public function mount($contract_id, $ip) {
        $this->contract_id = $contract_id;
        $this->ip = $ip;
        $this->attachmentsExists = (count(Attachmentdocuments::AttachmentsGroup($this->contract_id))>0) ? true : false;
    }

    public function render() {
        $document = Contracts::find($this->contract_id);
        foreach (json_decode($document->participants) as $participant) {
            if ($participant->correo === Auth::user()->email) {
                $rol = Rols::find($participant->rol)->select('name')->first();
                $participante = data_set($participant, 'rol_name', $rol->name);
                foreach (json_decode($document->document->customer_url) as $urls) {
                    if($urls->correo === $participant->correo){
                        $this->urlSign = $urls->url;
                    }
                }
            }
        }
        return view('livewire.received.show-document', compact('document', 'participante'));
    }
}
