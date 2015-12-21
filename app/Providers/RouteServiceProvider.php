<?php

namespace CompassHB\Www\Providers;

use Auth;
use CompassHB\Www\Blog;
use CompassHB\Www\Passage;
use CompassHB\Www\Series;
use CompassHB\Www\Sermon;
use CompassHB\Www\Song;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'CompassHB\Www\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        /*
         * A song is at /songs/{slug}
         */
        $router->bind('songs', function ($slug) {

            // Logged in users can see future posts
            if (Auth::check()) {
                return Song::where('slug', $slug)->firstOrFail();
            }

            return Song::where('slug', $slug)->firstOrFail();
        });

        /*
         * A passage is at /read/{slug}
         */
        $router->bind('read', function ($slug) {

            // Logged in users can see future posts
            if (Auth::check()) {
                return Passage::where('slug', $slug)->firstOrFail();
            }

            return Passage::where('slug', $slug)->published()->firstOrFail();
        });

        /*
         * A sermon is at /sermons/{slug}
         */
        $router->bind('sermons', function ($slug) {

            // Logged in users can see future posts
            if (Auth::check()) {
                return Sermon::where('slug', $slug)->firstOrFail();
            }

            return Sermon::where('slug', $slug)->published()->firstOrFail();
        });

        /*
         * A video is at /videos/{slug}
         */
        $router->bind('videos', function ($slug) {

            // Logged in users can see future posts
            if (Auth::check()) {
                return Sermon::where('slug', $slug)->firstOrFail();
            }

            return Sermon::where('slug', $slug)->published()->firstOrFail();
        });

        /*
         * A sermon series is at /series/{slug}
         */
        $router->bind('series', function ($slug) {
            return Series::where('slug', $slug)->firstOrFail();
        });

        /*
         * A blog is at /blog/{slug}
         */
        $router->bind('blog', function ($slug) {

            // Logged in users can see future posts
            if (Auth::check()) {
                return Blog::where('slug', $slug)->firstOrFail();
            }

            return Blog::where('slug', $slug)->published()->firstOrFail();
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
