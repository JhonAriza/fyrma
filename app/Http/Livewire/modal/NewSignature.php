<?php

namespace App\Http\Livewire\Modal;

use App\Models\Signatures;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewSignature extends Component
{
    public $open = false;
    public $signature;

    protected $rules = [
        'signature' => 'required|string',
    ];

    protected $listeners = ['newsignature'];

    public function render()
    {
        return view('livewire.modal.new-signature');
    }

    public function newsignature() {
        $this->open = true;
        $this->emit('opened');
    }

    public function savesignature() {
        $this->validate();
        Signatures::updateOrCreate(['user_id' => Auth::user()->id],['signature' => $this->signature]);
        $this->open = false;
        $this->emit('save_signature', 'Firma Cambiada con Exito');
    }
}
