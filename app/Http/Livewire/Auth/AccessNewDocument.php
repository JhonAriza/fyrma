<?php

namespace App\Http\Livewire\Auth;

use App\Models\Templates;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccessNewDocument extends Component {
    public $show = false;
    public $urls = [];
    public $search;
    
    public function render() {
        $this->links();
        return view('livewire.auth.access-new-document');
    }

    private function links() {
        $templates = Templates::where([['owner', Auth::user()->id]])
        ->where(function ($q) {
            $q->where('name',  'like' , '%'. $this->search .'%');
        })->take(3)->select('name','id')->get();
        
        $this->urls = [];
        foreach ($templates as $value) {
            $this->urls[] = [
                'name' => 'Nuevo documento en base a la plantilla '. $value->name,
                'route' => 'contracts/create/' . $value->id
            ];
        }
    }
}
