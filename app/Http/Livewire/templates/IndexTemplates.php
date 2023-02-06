<?php

namespace App\Http\Livewire\Templates;

use App\Models\Templates;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class IndexTemplates extends Component {
    use WithPagination;
    public $search;

    public function render() {
        $templates = Templates::where([['owner', Auth::user()->id]])
            ->where(function ($q) {
                $q->where('name',  'like' , '%'. $this->search .'%')
                    ->orWhere('vars',  'like' , '%'. $this->search .'%');
            })->paginate(10);
        return view('livewire.templates.index-templates', compact('templates'));
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function nuevo() {
        return redirect()->to('/templates/create/');
    }

    public function edit($id) {
        return redirect()->to("/templates/" . $id . "/edit");
    }

    public function generate($id) {
        return redirect()->to('/contracts/create/'. $id);
    }
}
