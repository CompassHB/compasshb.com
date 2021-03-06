<?php

namespace CompassHB\Www;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['deleted_at'];


    /**
     * A user can have many passages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passages()
    {
        return $this->hasMany(Passage::class);
    }

    /**
     * A user can have many sermons.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sermons()
    {
        return $this->hasMany(Sermon::class);
    }

    /**
     * A user can have many blogs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * A user can have many series.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function series()
    {
        return $this->hasMany(Series::class);
    }

}
