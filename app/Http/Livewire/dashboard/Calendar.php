<?php

namespace App\Http\Livewire\Dashboard;

use Asantibanez\LivewireCalendar\LivewireCalendar;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\Contracts;
use Illuminate\Support\Facades\Auth;

class Calendar extends LivewireCalendar
{
    public function events() : Collection
     {
          $documentos = Contracts::where('owner', Auth::user()->id)->get();
          $eventos = [];
          foreach ($documentos as $evento) {
              foreach ($evento->trackings as $tracking) {
                  $date = Carbon::parse($tracking->created_at);
                  $eventos[] = [
                      'id' => $evento->id,
                      'title' => $evento->document_name,
                      'description' => $tracking->owner . ' ' . $tracking->type . ' ' . $tracking->value,
                      'date' => $date,
                  ];
              }
          }
        return collect($eventos);
    }

    public function dataCalendar($data) {
    }
}