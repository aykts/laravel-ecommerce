<?php

namespace App\Listeners\v1\auth;

use App\Events\v1\auth\RegisterEvent;
use Illuminate\Auth\Events\Registered;

class SendRegisterNotification
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
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $userinfo = $event->user;
    }
}
