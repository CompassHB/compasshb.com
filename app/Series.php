<?php

namespace CompassHB\Www;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Series extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'image',
        'ministry',
    ];

    protected $dates = ['published_at', 'deleted_at'];

    /**
     * Set the empty field to be null using
     * a Larvel mutator function.
     *
     * @param $value
     */
    public function setMinistryAttribute($value)
    {
        $this->attributes['ministryId'] = $value ? $value : null;
    }

    /**
     * A series is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(self::class);
    }

    /**
     * A series has many sermons.
     *
     * @return HasMany
     */
    public function sermons()
    {
        return $this->hasMany(Sermon::class);
    }
}
