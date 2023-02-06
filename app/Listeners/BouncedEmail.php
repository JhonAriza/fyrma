<?php

namespace App\Listeners;

use App\Models\Trackings;
use jdavidbakr\MailTracker\Events\PermanentBouncedMessageEvent;

class BouncedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $main = "Ha rebotado el correo";

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PermanentBouncedMessageEvent  $event
     * @return void
     */
    public function handle(PermanentBouncedMessageEvent $event)
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
    }
}