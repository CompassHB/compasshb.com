<?php

namespace CompassHB\Www\Providers;

use CompassHB\Www\Blog;
use CompassHB\Www\Song;
use CompassHB\Www\Series;
use CompassHB\Www\Sermon;
use CompassHB\Www\Passage;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
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
            $object->alias = isset($object->alias) == true ?
                $object->alias : makeSlugFromTitle(new Sermon(), $object->title);
        });

        Series::saving(function ($object) {
            $object->alias = isset($object->alias) == true ?
                $object->alias : makeSlugFromTitle(new Series(), $object->title);
        });

        Passage::saving(function ($object) {
            $object->alias = isset($object->alias) == true ?
                $object->alias : makeSlugFromTitle(new Passage(), $object->title);
        });

        Song::saving(function ($object) {
            $object->alias = isset($object->alias) == true ?
                $object->alias : makeSlugFromTitle(new Song(), $object->title);
        });

        Blog::saving(function ($object) {
            $object->alias = isset($object->alias) == true ?
                $object->alias : makeSlugFromTitle(new Blog(), $object->title);
        });
    }
}
