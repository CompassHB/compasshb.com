<?php

namespace CompassHB\Www\Providers;

use Auth;
use CompassHB\Www\Series;
use CompassHB\Www\Sermon;
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
         * A sermon is at /sermons/{slug}
         */
        $router->bind('sermons', function ($slug) {

            // Logged in users can see future posts
            if (Auth::check()) {
                return Sermon::where('alias', $slug)->firstOrFail();
            }

            return Sermon::where('alias', $slug)->published()->firstOrFail();
        });

        /*
         * A video is at /videos/{slug}
         */
        $router->bind('videos', function ($slug) {

            // Logged in users can see future posts
            if (Auth::check()) {
                return Sermon::where('alias', $slug)->firstOrFail();
            }

            return Sermon::where('alias', $slug)->published()->firstOrFail();
        });

        /*
         * A sermon series is at /series/{slug}
         */
        $router->bind('series', function ($slug) {
            return Series::where('alias', $slug)->firstOrFail();
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
