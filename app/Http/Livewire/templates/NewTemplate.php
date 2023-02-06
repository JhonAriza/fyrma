<?php

namespace App\Http\Livewire\Templates;

use App\Models\Templates;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Rules\NotInArray;

use Livewire\Component;

class NewTemplate extends Component {

    public $content;
    public $name;
    public $list = [];
    public $newVar;

    protected $listeners = ['changed_var_list'];
    protected $rules = [
        'name' => 'required|max:50',
        'list' => '',
        "content" => 'required|min:20'
    ];

    protected $messages = [
        'name.required' => 'El nombre del documento  es obligatorio.',
        'name.max' => 'El nombre no debe contener mas de 50 caracteres.',
        'content.required' => 'agregar  variables  es obligatorio.',
        'content.min' => 'El contenido debe contener mas de 20 caracteres.',
        'newVar.max' => 'La nueva variable no debe contener mas de 20 caracteres.',
        'newVar.min' => 'La nueva variable no debe contener menos de 3 caracteres.',
        'newVar.required' => 'La nueva variable es obligatorio.',
        'newVar.max' => 'La nueva variable ya existe.',
    ];

    public function save() {
        $this->validate();

        $template = new Templates;
        $template->name = $this->name;
        $template->owner = Auth::user()->id;
        $template->vars = json_encode($this->list);
        $template->html = $this->content;
        $template->save();

        $this->reset('content','name','list','newVar');
        $this->emit('clean');
        $this->emit('save_success', 'Plantilla creada exitosamente');
    }

    public function render() {
        return view('livewire.templates.new-template');
    }

    // listener para actualizar lista de variables
    public function changed_var_list($list, $type) {
        if($type) {
            $this->list[] = $list;
        } else {
            $this->list = array_filter($this->list, function ($item) use ($list){
                return $item != $list;
            });
        }
    }
}
