<?php

namespace App\Http\Controllers;

use App\Models\Contracts;
use App\Models\Documents;
use App\Models\Trackings;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class NotificationsController extends Controller { 

    public $participantes = [];
    public $urls = [];

    public function __construct($participantes) {
        $this->participantes = $participantes;
    }
    
    public function notificationNewContract($contract, $owner) {
        foreach ($this->participantes as $participant) {
            $customer_email = $participant['correo'];
            $url = URL::signedRoute(
                'contracts.pendingSignature',
                ['con' => Crypt::encryptString($contract->document_id), 'use' => Crypt::encryptString($customer_email)]
            );
        
            Notification::route('mail', $customer_email)
                ->notify(new NewContract($contract, $participant, $owner, $url));
                
            $track = new Trackings;
            $track->owner = Auth::user()->name;
            $track->contract_id = $contract->document_id;
            $track->type = 'ha enviado';
            $track->value = 'contrato al correo ' . $customer_email;
            $track->save();

            $urls[] = [
                'correo' => $customer_email,
                'url'    => $url
            ];
        }

        $mail = Contracts::where("id", $contract->document_id)->first();
        $mail->document->customer_url = ($urls);
        $mail->document->save();
    }
}