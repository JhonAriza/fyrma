<?php

namespace App\Http\Livewire\shared;
use App\Models\Tag;
use App\Models\Attachmentdocuments;
use Livewire\Component;
use App\Models\Contracts;
use Illuminate\Support\Facades\Auth;
class Tags extends Component
{
    public $show = false;
    public $name_tag;
    public $contract_id;
    public $tags;
    public $owner = false;
    protected $rules = [
        'name_tag' =>'required|min:3|max:20'     
    ];
    protected $messages = [
        'name_tag.required' => 'el nombre de la etiqueta es  obligatorio.',
        'name_tag.min' => 'la etiqueta debe tener mas de 3 caracteres.',
        'name_tag.max' => 'maximo 20 caracteres.',

    ];
    //-- usamos el modelo para traer todos los registros
    public function render()
    { 
         $tag = Tag::where('contract_id',$this->contract_id)->get();
        return view('livewire.shared.tags',compact("tag"));
    }
    public function mount($contract_id)
    {
       $this->contract = Contracts::find($contract_id);
       $this->owner = (Auth::user()->id === $this->contract->owner);
     
    }
     //-- guardar
     public function save()
     {          
       $this->validate();
       $new = new Tag();
       $new->contract_id = $this->contract_id;
       $new->name_tag = $this->name_tag;
       $new->save();
       $this->reset(['name_tag','show']);
     }
//--eliminar
public function delete(Tag $id)
{
    $id->delete();
}
}