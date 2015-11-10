<?php

namespace CompassHB\Www\Providers;

use CompassHB\Www\Blog;
use CompassHB\Www\Song;
use CompassHB\Www\Series;
use CompassHB\Www\Sermon;
use CompassHB\Www\Passage;
use CompassHB\Www\Events\LogUserLastLogin;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'auth.login' => [
            LogUserLastLogin::class,
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        // Create slugs on model save
        Sermon::saving(function ($object) {
            $object->slug = isset($object->slug) == true ? $object->slug : makeSlugFromTitle(new Sermon(), $object->title);
        });

        Series::saving(function ($object) {
            $object->slug = isset($object->slug) == true ? $object->slug : makeSlugFromTitle(new Series(), $object->title);
        });

        Passage::saving(function ($object) {
            $object->slug = isset($object->slug) == true ? $object->slug : makeSlugFromTitle(new Passage(), $object->title);
        });

        Song::saving(function ($object) {
            $object->slug = isset($object->slug) == true ? $object->slug : makeSlugFromTitle(new Song(), $object->title);
        });

        Blog::saving(function ($object) {
            $object->slug = isset($object->slug) == true ? $object->slug : makeSlugFromTitle(new Blog(), $object->title);
        });
    }
}
