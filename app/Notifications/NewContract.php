<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContract extends Notification {
    use Queueable;

    public $contract;
    public $url;
    public $participant;
    public $owner;

    public function __construct($contract, $participant, $owner, $url) {
        $this->contract = $contract;
        $this->participant = $participant;
        $this->url = $url;
        $this->owner = $owner;
    }

    public function via($notifiable) {
        return ['mail'];
    }

    public function toMail($notifiable) {
        return (new MailMessage)
            ->subject('Notificacion de Nuevo Contrato')
            ->greeting('Estimado ' . $this->participant['nombre'])
            ->line('Le notificamos que posee un contrato en estado ' . $this->participant['status'] . ' enviado por ' . $this->owner->name)
            ->action('Ver Contrato', url($this->url))
            ->line('')
            ->line('Este mensaje y cualquier archivo adjunto que contenga son confidenciales. Si usted no es el destinatario por favor llame o envíe un correo electrónico al relacionado anteriormente y bórrelo de su sistema, sin copiar, modificar o divulgar su contenido. Gracias. // This message and any attached file that it contains are confidential. If you are not the addressee, please call us or send an e-mail to the sender and erase it of the system, without copying, modifying or to spread the content. Thank you.')
            ->withSwiftMessage(function ($message) {
                $message->getHeaders()->addTextHeader('Model-CC-ID', $this->contract->document_id);
                $message->getHeaders()->addTextHeader('Model-type', "NewContract");
            });

    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
