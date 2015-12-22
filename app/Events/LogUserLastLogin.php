<?php

namespace CompassHB\Www\Events;

use Carbon\Carbon;
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
     * @param $remember
     */
    public function handle(User $user, $remember)
    {
        $user->last_login = Carbon::now();
        $user->save();
    }
}
