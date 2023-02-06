<?php

namespace App\Http\Livewire\Templates;

use App\Models\Templates;
use Livewire\Component;

class EditTemplates extends Component {

    public $content;
    public $template;
    public $name;
    public $list = [];
    public $template_id;

    protected $listeners = ['changed_var_list'];

    protected $rules = [
        'name' => 'required|max:50',
        'list' => '',
        "content" => 'required|min:20'
    ];
    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'name.max' => 'El nombre no debe contener mas de 50 caracteres.',
        'content.required' => 'El contenido es obligatorio.',
        'content.min' => 'El contenido debe contener mas de 20 caracteres.',
        'newVar.max' => 'La nueva variable no debe contener mas de 20 caracteres.',
        'newVar.min' => 'La nueva variable no debe contener menos de 3 caracteres.',
        'newVar.required' => 'La nueva variable es obligatorio.',
        'newVar.max' => 'La nueva variable ya existe.',
    ];

    public function mount($id) {
        $this->template_id = $id;
        $this->template = Templates::find($id);
        $this->name = $this->template->name;
        $this->list = json_decode($this->template->vars);
        $this->content = $this->template->html;
    }

    public function render() {
        return view('livewire.templates.edit-templates');
    }

    public function save() {
        $this->validate();
        $this->template->html = $this->content;
        $this->template->vars = json_encode($this->list);
        $this->template->name = $this->name;
        $this->template->update();
        $this->emit('save_success', 'Plantilla editada exitosamente');
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
