<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use jdavidbakr\MailTracker\Events\EmailDeliveredEvent;

class EmailDelivered
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EmailDelivered  $event
     * @return void
     */
    public function handle(EmailDelivered $event)
    {
        Storage::put('delivered.txt', print_r($event, true));

        // Access the model using $event->sent_email
        // Access the IP address that triggered the event using $event->ip_address
    }
}