<?php

namespace CompassHB\Www\Events;

use CompassHB\Www\User;

class LogUserLastLogin
{
    /**
     * Create the event handler.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param User $user
     */
    public function handle(User $user, $remember)
    {
        $user->last_login = \Carbon\Carbon::now();
        $user->save();
    }
}
