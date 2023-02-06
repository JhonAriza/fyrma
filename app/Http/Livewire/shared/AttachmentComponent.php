<?php

namespace App\Http\Livewire\Shared;


use Livewire\Component;
use App\Models\Contracts;
use Illuminate\Support\Facades\Auth;
use App\Models\Attachmentdocuments;
use Illuminate\Support\Arr;
use App\Models\AllowedTypes;
use Illuminate\Http\Testing\MimeType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AttachmentComponent extends Component
{
    public $id_participant, $contract_id;
    public $owner = false;
    public $attachments = [];
    public $types = [];
    public $extension;
    public $fileName;
    public $extensionPoint;
    protected $listeners = ['save_attachment'];

    public function render()
    {
        if ($this->owner) {
            $this->attachments = Attachmentdocuments::AttachmentsContract($this->contract_id);
        } else {
            $this->attachments = Attachmentdocuments::MyAttachments($this->contract_id, $this->id_participant);
        }
        return view('livewire.shared.attachment-component');
    }

    public function mount($contract_id)
    {
        $this->contract_id = $contract_id;
        $this->contract = Contracts::find($contract_id);
        $this->owner = (Auth::user()->id === $this->contract->owner) ? true : false;
        $this->searchmyparticipant();
    }

    public function validateAttachment($type, $id)
    {
        $annexe = Attachmentdocuments::find($id);
        $annexe->update(['status' => $type]);
        if (!$type) {
            $annexe->update(['attachmentdocument_document' => null]);
        }
    }

    public function save_attachment($id, $base64, $extensionPoint, $extension, $fileName)
    {
        DB::beginTransaction();
        try {
            // en este metodo save_attachment recibo parametro extencion
            $this->extension = $extension;
            $this->fileName = $fileName;
            $this->extensionPoint = $extensionPoint;
            
            if (!$base64) {
                $this->addError('key', 'Anexo no valido o vacio');
            } else {
                $mimeType = MimeType::get($extension);
                $this->types = AllowedTypes::MyAllowedTypesByAccept($mimeType);
                if(!$this->types->isEmpty()){
                    $this->attachments[$id]->attachmentdocument_document = $base64;
                    //en este campo attachment_filename  agrego  nombre concatenado con el participante y extencion
                    $this->attachments[$id]->attachment_filename = $this->attachments[$id]->attachmentdocument_name . $this->attachments[$id]->participant . $extensionPoint;
                    $this->attachments[$id]->update();
                    $this->emit('save_success', 'Anexo Cargado Exitosamente');
                    DB::commit();
                } else {
                    $this->emit('save_error');
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('error', $e->getMessage());
        };
    }

    private function searchmyparticipant() {
        $part = Arr::where(json_decode($this->contract->participants), function ($value) {
            return $value->correo == Auth::user()->email;
        });
        $this->id_participant = (count($part)) ? Auth::user()->email : null;
    }
}
