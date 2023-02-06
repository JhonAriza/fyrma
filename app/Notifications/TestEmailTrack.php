<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TestEmailTrack extends Notification
{
    use Queueable;

    public $customer;
    public $url;

    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notificacion de Nuevo Contrato')
            ->line('Le notificamos que posee un contrato pendiente por la empresa X')
            ->withSwiftMessage(function ($message) {
                $message->getHeaders()->addTextHeader('X-Model-ID', '1');
            });

    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
