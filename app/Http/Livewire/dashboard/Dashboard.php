<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Contracts;
use Livewire\Component;
use App\Models\Trackings;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Dashboard extends Component
{
    public $contract_id;
    public $search;
    public $open = false;
    public $show = false;
    public $trackings;
    public $contractCollection;
    public $fechaPre;

    public function render() {
        $documentos = Contracts::where('owner', Auth::user()->id)->orderBy('created_at', 'ASC')->get();
        $eventos = [];
        foreach ($documentos as $evento) {
            foreach ($evento->trackings as $tracking) {
                $date = Carbon::parse($tracking->created_at);
                $eventos[$date->format('y-m-d')][] = [
                    'id' => $evento->id,
                    'title' => $evento->document_name,
                    'description' => $tracking->owner . ' ' . $tracking->type . ' ' . $tracking->value,
                    'date' => $date,
                ];
            }
        }
        //dd($eventos);
        return view('livewire.dashboard.dashboard', compact('eventos'));
    }
}
