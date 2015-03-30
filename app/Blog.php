<?php namespace CompassHB\Www;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'body',
        'video',
        'byline',
        'thumbnail',
        'published_at',
    ];

    protected $dates = ['published_at'];

    /**
     * Set the empty video field to be null using
     * a Laravel mutator function.
     */
    public function setVideoAttribute($value)
    {
        $this->attributes['video'] = (!$value) ? null : $value;
    }

    /**
     * Set the empty field to be null using
     * a Laravel mutator function.
     */
    public function setThumbnailAttribute($value)
    {
        $this->attributes['thumbnail'] = (!$value) ? null : $value;
    }

    /**
     * Set the empty field to be null using
     * a Laravel mutator function.
     */
    public function setBylineAttribute($value)
    {
        $this->attributes['byline'] = (!$value) ? null : $value;
    }

    /**
     * A blog is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('CompassHB\Www\Blog');
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
