<?php

namespace App\Http\Livewire\contracts;

use App\Models\Contracts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class IndexContracts extends Component {
    use WithPagination;

    public $search;

    public function render() {
        $contracts = Contracts::where([['owner', Auth::user()->id]])
            ->where(function ($q) {
                $q->where('document_name', 'like', '%' . $this->search . '%')
                ->orWhere('participants', 'like', '%' . $this->search . '%');
            })
            ->orderBy('document_id','desc')
            ->paginate(10);

        return view('livewire.contracts.index-contracts', compact('contracts'));
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function tracking($id) {
        $this->emit('showTracking', $id);
    }
}
