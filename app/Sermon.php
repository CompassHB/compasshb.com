<?php

namespace CompassHB\Www;

use Illuminate\Database\Eloquent\Model;
use CompassHB\Www\Repositories\Transcoder\ZencoderTranscoderRepository;

class Sermon extends Model
{
    protected $fillable = [
        'title',
        'body',
        'excerpt',
        'worksheet',
        'bulletin',
        'file',
        'teacher',
        'text',
        'video',
        'ministry',
        'series_id',
        'published_at',
    ];

    protected $dates = ['published_at'];

    /**
     * Set the empty field to be null using
     * a Larvel mutator function.
     *
     * @param $value
     */
    public function setSeriesIdAttribute($value)
    {
        $this->attributes['series_id'] = $value ? $value : null;
    }

    /**
     * Set the empty field to be null using
     * a Larvel mutator function.
     *
     * @param $value
     */
    public function setExcerptAttribute($value)
    {
        $this->attributes['excerpt'] = $value ? $value : null;
    }

    /**
     * Set the empty field to be null using
     * a Larvel mutator function.
     *
     * @param $value
     */
    public function setBulletinAttribute($value)
    {
        $this->attributes['bulletin'] = $value ? $value : null;
    }

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
     * Set the empty field to be null using
     * a Laravel mutator function.
     */
    public function setVideoAttribute($value)
    {
        $this->attributes['video'] = $value;

        // Set the audio attribute
        $transcoder = new ZencoderTranscoderRepository();

        // Only transcode in production when there is a video file and the audio URL is blank.
        if (env('APP_ENV') == 'production' &&
            array_key_exists('ministry', $this->attributes) &&
            empty($this->attributes['audio']) &&
            $value != null) {
            $job = $transcoder->saveAudio(route('sermons.show', str_slug($this->attributes['title']).'/download.mp4'), str_slug($this->attributes['title']));
            $this->attributes['audio'] = $job->outputs[0]->url;
        }
    }

    /**
     * A sermon is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(self::class);
    }

    /**
     * A sermon belongs to a series.
     *
     * @return BelongsTo
     */
    public function series()
    {
        return $this->belongsTo(Series::class);
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
