<?php namespace CompassHB\Www;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

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

	/**
	 * A user can have many songs
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function songs()
	{
		return $this->hasMany('CompassHB\Www\Song');
	}

	/**
	 * A user can have many passages
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function passages()
	{
		return $this->hasMany('CompassHB\Www\Passage');
	}

	/**
	 * A user can have many fellowships
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function fellowships()
	{
		return $this->hasMany('CompassHB\Www\Fellowship');
	}

	/**
	 * A user can have many sermons
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function sermons()
	{
		return $this->hasMany('CompassHB\Www\Sermon');
	}
}
