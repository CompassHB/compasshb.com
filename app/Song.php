<?php

namespace CompassHB\Www;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'title',
        'body',
        'excerpt',
        'video',
        'audio',
        'published_at',
    ];

    protected $dates = ['published_at'];

    /**
     * Set the empty field to be null using
     * a Laravel mutator function.
     */
    public function setExcerptAttribute($value)
    {
        $this->attributes['excerpt'] = (!$value) ? null : $value;
    }

    /**
     * A song is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(self::class);
    }

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = \Carbon\Carbon::parse($date);
    }

    /**
     * Get the published_at attribute.
     *
     * @param $date
     *
     * @return string
     */
    public function getPublishedAtAttribute($date)
    {
        return new \Carbon\Carbon($date);
    }

    public function scopeUnpublished($query)
    {
        $query->where('published_at', '>', \Carbon\Carbon::now());
    }

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', \Carbon\Carbon::now());
    }
}
