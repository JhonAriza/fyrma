<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'jdavidbakr\MailTracker\Events\ViewEmailEvent' => [
            'App\Listeners\EmailViewed',
        ],
        'jdavidbakr\MailTracker\Events\PermanentBouncedMessageEvent' => [
            'App\Listeners\BouncedEmail',
        ],
        'jdavidbakr\MailTracker\Events\EmailDeliveredEvent' => [
            'App\Listeners\EmailDelivered',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
