<?php

namespace App\Http\Livewire\Received;

use App\Models\Attachmentdocuments;
use App\Models\Contracts;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ReceivedDocuments extends Component {
    use WithPagination;
    public $search;

    public function render() {
        $recibidos = Contracts::where([['owner', '!=', Auth::user()->id]])
            ->where(function ($q){
                $q->where('participants', 'like', '%'. $this->search .'%')
                ->orwhere('document_name', 'like', '%' . $this->search . '%')
                ->orwhere('status', 'like', '%'. $this->search .'%')
                ->orderBy('document_id','desc');
            })
            ->where('participants', 'like', '%' .  Auth::user()->email . '%')
            ->where('status', 'not like', '%Borrador%')
            ->paginate(10);
        return view('livewire.received.received-documents', compact('recibidos'));
    }

    public function show($id) {
        return redirect()->to('/received/'. $id);
    }
}
