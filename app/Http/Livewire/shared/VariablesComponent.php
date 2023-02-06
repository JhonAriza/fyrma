<?php

namespace App\Http\Livewire\Shared;

use App\Rules\NotInArray;
use Livewire\Component;
use Illuminate\Support\Str;

class VariablesComponent extends Component
{
    public $list = [];
    public $content;
    public $new_var;
    public $show = true;

    protected $listeners = ['editor_content'];

    public function render()
    {
        return view('livewire.shared.variables-component');
    }
    
    public function add() {
        $this->validate([
            'new_var' => ['required','min:3','string', 
            new NotInArray($this->list, 'nueva variable')]
        ]);

        $this->list[] = $this->new_var;
        $this->emit('changed_var_list', $this->new_var, true);
        $this->reset('new_var');
    }

    public function remove($key_list) {
        $this->content = Str::remove("[". $this->list[$key_list] . "]", $this->content);
        $this->emit('change', $this->content);
        $this->emit('changed_var_list', $this->list[$key_list], false);
        unset($this->list[$key_list]);
    }

    public function editor_content($content) {
        $this->content = $content;
    }
}
