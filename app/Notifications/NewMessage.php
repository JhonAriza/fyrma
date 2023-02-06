<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessage extends Notification
{
    use Queueable;

    public $customer;
    public $url;

    public function __construct($customer, $url)
    {
        $this->customer = $customer;
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            // ->bcc('respaldo_comprobantes@respaldo_comprobantes.com')
            // ->cc($this->facturador->correo)
            ->subject('Notificacion de Nuevo Contrato')
            ->greeting('Estimado ' . $this->customer)
            // ->line('Estimado cliente '. $this->cliente->razon_social .' este correo es generado automáticamente, por favor no responda a este mensaje.')
            // ->line('Usted posee una nueva factura electronica de '. $this->facturador->razon_social)
            ->line('Le notificamos que posee un contrato pendiente por la empresa X')
            ->action('Ver Contrato', url($this->url))
            // ->line('correo: ' .$this->facturador->correo)
            // ->line('telefono: ' .$this->facturador->telefono)
            ->line('')
            ->line('Este mensaje y cualquier archivo adjunto que contenga son confidenciales. Si usted no es el destinatario por favor llame o envíe un correo electrónico al relacionado anteriormente y bórrelo de su sistema, sin copiar, modificar o divulgar su contenido. Gracias. // This message and any attached file that it contains are confidential. If you are not the addressee, please call us or send an e-mail to the sender and erase it of the system, without copying, modifying or to spread the content. Thank you.');

    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
