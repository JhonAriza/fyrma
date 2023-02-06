<?php

namespace App\Listeners;

use App\Models\Trackings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use jdavidbakr\MailTracker\Events\ViewEmailEvent;

class EmailViewed
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public $main = "Ha Abierto el Correo";

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ViewEmailEvent  $event
     * @return void
     */
    public function handle(ViewEmailEvent $event)
    {
        $contract_id = $event->sent_email->getHeader('Model-CC-ID');
        $type = $event->sent_email->getHeader('Model-type');

        if($type == "NewContract") {
            $track = new Trackings();
            $track->owner = $event->sent_email->recipient_email;
            $track->contract_id = $contract_id;
            $track->type = '';
            $track->value = $this->main;
            $track->save();
        }

        // Access the model using $event->sent_email
        // Access the IP address that triggered the event using $event->ip_address
    }
}