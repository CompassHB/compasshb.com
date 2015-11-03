<?php

namespace CompassHB\Www;

use Spatie\SearchIndex\Searchable;
use Illuminate\Database\Eloquent\Model;

class Series extends Model implements Searchable
{
    protected $fillable = [
        'title',
        'body',
        'image',
        'ministry',
    ];

    /**
     * Set the empty field to be null using
     * a Larvel mutator function.
     *
     * @param $value
     */
    public function setMinistryAttribute($value)
    {
        $this->attributes['ministry'] = $value ? $value : null;
    }

    /**
     * A series is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Series::class);
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

    /**
     * Returns an array with properties which must be indexed.
     *
     * @return array
     */
    public function getSearchableBody()
    {
        $searchableProperties = [
            'title' => $this->title,
            'body' => $this->body,
            'ministry' => $this->ministry,
            'slug' => $this->slug,
        ];

        return $searchableProperties;
    }

    /**
     * Return the type of the searchable subject.
     *
     * @return string
     */
    public function getSearchableType()
    {
        return 'series';
    }

    /**
     * Return the id of the searchable subject.
     *
     * @return string
     */
    public function getSearchableId()
    {
        return $this->id;
    }
}
