<?php

namespace CompassHB\Www;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * Get all of the users that belong to the team.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user', 'team_id', 'user_id')->withPivot('role');
    }
}
