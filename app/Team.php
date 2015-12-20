<?php

namespace CompassHB\Www;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Get all of the users that belong to the team.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user', 'team_id', 'user_id')->withPivot('role');
    }
}
