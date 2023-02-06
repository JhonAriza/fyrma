<?php

namespace App\Http\Livewire\Test;

use App\Notifications\TestEmailTrack;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class Email extends Component
{
    public function render()
    {
        return view('livewire.test.email');
    }

    public function add() {

        Notification::route('mail', "jesusmancilla16@gmail.com")
            ->notify(new TestEmailTrack());

        // dd("hola");
    }
}
