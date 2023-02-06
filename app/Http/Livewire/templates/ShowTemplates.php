<?php

namespace App\Http\Livewire\Templates;

use Livewire\Component;

class ShowTemplates extends Component {
    
    public $open = false;

    public function render() {
        return view('livewire.templates.show-templates');
    }
}
