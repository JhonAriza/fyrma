<?php

namespace App\Http\Livewire\components;

use App\Models\Comments as ModelsComments;
use App\Models\Trackings;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comments extends Component {

    public $contract, $block, $message;
    public $owner_contract;
    
    protected $listeners = ['comments'];

    public function render() {
        $coments = ModelsComments::where('contract_id', $this->contract)
            ->where('block', $this->block)
            ->get();
        return view('livewire.components.comments', compact('coments'));
    }

    public function comments($block, $contract) {
        $this->block = $block;
        $this->contract = $contract;
    }

    public function add_comment() {
        $this->validate([
            'message' => 'required|min:3|string'
        ]);

        $new = new ModelsComments();
        $new->contract_id = $this->contract;
        $new->block = $this->block;
        $new->owner = Auth::user()->id;
        $new->message = $this->message;
        $new->save();

        $track = new Trackings;
        $track->owner = Auth::user()->name;
        $track->contract_id = $this->contract;
        $track->type = '';
        $track->value = 'Ha escrito un comentario';
        $track->save();
        
        $this->emit('showhtml', $this->contract);
        $this->reset('message');
    }
}