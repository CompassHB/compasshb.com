<?php

namespace CompassHB\Www\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. You can add your own bindings too!
     */
    public function register()
    {
        /*
         * Laravel Generators for development
         */
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }

        /*
         * Analytics
         */
        $this->app->bind(
            'CompassHB\Www\Contracts\Analytics',
            $this->app->environment() == 'local' ?
            'CompassHB\Www\Repositories\Analytics\FakeAnalyticRepository' :
            'CompassHB\Www\Repositories\Analytics\GoogleAnalyticRepository'
        );

        /*
         * Event
         */
        $this->app->bind(
            'CompassHB\Www\Contracts\Events',
            'CompassHB\Www\Repositories\Event\EventbriteEventRepository'
        );

        /*
         * Photo
         */
        $this->app->bind(
            'CompassHB\Www\Contracts\Photos',
            'CompassHB\Www\Repositories\Photo\SmugmugPhotoRepository'
        );

        /*
         * VideoRepository
         */
        $this->app->bind(
            'CompassHB\Www\Contracts\Video',
            'CompassHB\Www\Repositories\Video\CompassVideoRepository'
        );

        /*
         * Scripture
         */
        $this->app->bind(
            'CompassHB\Www\Contracts\Scripture',
            'CompassHB\Www\Repositories\Scripture\EsvScriptureRepository'
        );

        /*
         * Plan
         */
        $this->app->bind(
            'CompassHB\Www\Contracts\Plan',
            'CompassHB\Www\Repositories\Plan\PcoPlanRepository'
        );

        /*
         * Upload
         */
        $this->app->bind(
            'CompassHB\Www\Contracts\Upload',
            'CompassHB\Www\Repositories\Upload\AwsUploadRepository'
        );

        /*
         * Transcoder
         */
        $this->app->bind(
            'CompassHB\Www\Contracts\Transcoder',
            'CompassHB\Www\Repositories\Transcoder\ZencoderTranscoderRepository'
        );
    }
}
