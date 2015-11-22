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
         * EventRepository
         */
        $this->app->bind(
            'CompassHB\Www\Repositories\Event\EventRepository',
            'CompassHB\Www\Repositories\Event\EventbriteEventRepository'
        );

        /*
         * PhotoRepository
         */
        $this->app->bind(
            'CompassHB\Www\Contracts\Photos',
            'CompassHB\Www\Repositories\Photo\SmugmugPhotoRepository'
        );

        /*
         * VideoRepository
         */
        $this->app->bind(
            'CompassHB\Www\Repositories\Video\VideoRepository',
            'CompassHB\Www\Repositories\Video\CompassVideoRepository'
        );

        /*
         * ScriptureRepository
         */
        $this->app->bind(
            'CompassHB\Www\Repositories\Scripture\ScriptureRepository',
            'CompassHB\Www\Repositories\Scripture\EsvScriptureRepository'
        );

        /*
         * PlanRepository
         */
        $this->app->bind(
            'CompassHB\Www\Contracts\Plan',
            'CompassHB\Www\Repositories\Plan\PcoPlanRepository'
        );

        /*
         * UploadRepository
         */
        $this->app->bind(
            'CompassHB\Www\Repositories\Upload\UploadRepository',
            'CompassHB\Www\Repositories\Upload\AwsUploadRepository'
        );

        /*
         * TranscoderRepository
         */
        $this->app->bind(
            'CompassHB\Www\Repositories\Transcoder\TranscoderRepository',
            'CompassHB\Www\Repositories\Transcoder\ZencoderTranscoderRepository'
        );
    }
}
