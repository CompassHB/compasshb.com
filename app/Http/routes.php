<?php

/*
 * Route for songs.
 */
Route::resource('songs', 'SongsController', ['except' => ['destroy']]);

/*
 * Route for passages
 */
Route::resource('read', 'PassagesController', ['except' => ['destroy']]);

/*
 * Route for sermons
 */
Route::resource('sermons', 'SermonsController', ['except' => ['destroy']]);
Route::get('sermons/{sermons}/download.mp4', [
    'as' => 'sermons.download',
    'uses' => 'SermonsController@download',
]);

/*
 * Route for videos
 */
Route::resource('videos', 'SermonsController', ['except' => ['destroy']]);
Route::get('videos/{videos}/download.mp4', [
    'as' => 'videos.download',
    'uses' => 'SermonsController@download',
]);

/*
 * Route for sermon series
 */
Route::resource('series', 'SeriesController', ['except' => ['destroy']]);

/*
 * Route for blogs
 */
Route::resource('blog', 'BlogsController', ['except' => ['destroy']]);
Route::get('blog/{blog}/{locale}', [
    'as' => 'blogs.language',
    'uses' => 'BlogsController@language',
]);

/*
 * Route for fellowship
 */
Route::get('fellowship', [
    'as' => 'fellowship.index',
    'uses' => 'FellowshipsController@index',
]);

Route::get('fellowship/{id}/{slug}', [
    'as' => 'fellowship.show',
    'uses' => 'FellowshipsController@show',
]);

Route::get('study/{book?}/{chapter?}', [
    'as' => 'study',
    'uses' => 'StudyController@index',
]);

/*
 * Route for homepage
 */
Route::get('/', [
    'as' => 'home',
    'uses' => 'PagesController@home',
]);

/*
 * Route for photos
 */
Route::get('photos', [
    'as' => 'photos',
    'uses' => 'PagesController@photos',
]);

/*
 * Route for pray
 */
Route::get('pray', [
    'as' => 'pray',
    'uses' => 'PagesController@pray',
]);

/*
 * Route for search
 */
Route::get('search', [
    'as' => 'search',
    'uses' => 'PagesController@search',
]);
/*
 * Routes for feeds
 */
Route::group(['prefix' => 'feed', 'as' => 'feed.'], function () {

    Route::get('sermons', [
        'as' => 'sermons',
        'uses' => 'FeedsController@sermons',
    ]);

    Route::get('sermonaudio', [
        'as' => 'sermonaudio',
        'uses' => 'FeedsController@sermonaudio',
    ]);

    Route::get('sermons.json', [
        'middleware' => 'cors',
        'as' => 'sermons.json',
        'uses' => 'FeedsController@json',
    ]);

    Route::get('blog.xml', [
        'as' => 'blog.xml',
        'uses' => 'FeedsController@blog',
    ]);

    Route::get('read.xml', [
        'as' => 'read.xml',
        'uses' => 'FeedsController@read',
    ]);
});

/**
 * Routes for pages
 */
Route::get('goody-two-shoes', [
           'as' => 'goody-two-shoes',
           'uses' => 'PagesController@goodytwoshoes',
       ]);

/*
 * Routes for APIs
 */
Route::group(['prefix' => 'api/v1'], function () {
    Route::resource('songs', 'Api\SongsController', ['except' => ['destroy']]);
    Route::get('passages', [
        'middleware' => 'cors',
        'uses' => 'Api\PassagesController@index',
    ]);
    Route::resource('sermons', 'Api\SermonsController', [
            'middleware' => 'cors',
            'except' => ['destroy'],
        ]);
    Route::resource('series', 'Api\SeriesController', ['except' => ['destroy']]);
    Route::resource('blog', 'Api\BlogController', ['except' => ['destroy']]);
    Route::get('cleareventcache/{auth?}', [
        'as' => 'cleareventcache',
        'uses' => 'PagesController@cleareventcache',
    ]);
    Route::get('clearvideothumbcache/{auth?}', [
        'as' => 'clearvideothumbcache',
        'uses' => 'PagesController@clearvideothumbcache',
    ]);
});

/**
 * Routes for CompassHB.2016
 */
Route::resource('api/v2/sermons', 'Api\APIController', [
    'except' => ['destroy', 'edit', 'create', 'store', 'update']
]);

Route::group(['prefix' => 'api/1.0'], function () {
    Route::get('getsermonlist.json', 'FeedsController@getsermonlist');
});

/*
 * Routes for static pages
 */
Route::get('who-we-are', [
    'as' => 'who-we-are',
    'uses' => 'PagesController@whoweare',
]);

Route::get('eight-distinctives', [
    'as' => 'distinctives',
    'uses' => 'PagesController@eightdistinctives',
]);

Route::get('give', [
    'as' => 'give',
    'uses' => 'PagesController@give',
]);

Route::get('giving', [
    'as' => 'giving',
    'uses' => 'PagesController@giving',
]);

Route::get('ice-cream-evangelism', [
    'as' => 'evangelism',
    'uses' => 'PagesController@icecreamevangelism',
]);

Route::get('what-we-believe', [
    'as' => 'believe',
    'uses' => 'PagesController@whatwebelieve',
]);

Route::get('events/{id?}/{slug?}', [
    'as' => 'events.index',
    'uses' => 'PagesController@events',
]);

/***********************************************************************
 * Routes for ministry pages
 */

/*
 * Route for Kids ministry
 */
Route::get('kids', [
    'as' => 'kids',
    'uses' => 'MinistryController@kids',
]);

/*
 * Route for Youth ministry
 */
Route::get('youth', [
    'as' => 'youth',
    'uses' => 'MinistryController@youth',
]);

/*
 * Route for Sunday School ministry
 */
Route::group(['prefix' => 'sundayschool'], function () {

    Route::get('/', [
        'as' => 'sundayschool',
        'uses' => 'MinistryController@sundayschool',
    ]);

});

/*
 * Route for college ministry
 */
Route::get('college', [
    'as' => 'college',
    'uses' => 'MinistryController@college',
]);

/*
 * Route for men
 */
Route::get('men', [
    'as' => 'men',
    'uses' => 'MinistryController@men',
]);

/*
 * Route for women
 */
Route::get('women', [
    'as' => 'women',
    'uses' => 'MinistryController@women',
]);

/*
 * Routes for landing pages
 */
Route::get('bunnyrun', ['as' => 'bunnyrun',
    'uses' => 'PagesController@bunnyrun',
]);
Route::get('resurrectionweek', ['as' => 'bunnyrun',
    'uses' => 'PagesController@resurrectionweek',
]);
/*
 * Route for marriage
 */
Route::get('marriage', [
    'as' => 'marriage',
    'uses' => 'MinistryController@marriage',
]);

/*
 * Analytics Sitemap XML
 */
Route::get('sitemap.xml', [
    'as' => 'sitemap',
    'uses' => 'PagesController@sitemap',
]);

/*
 * Manifest file
 */
Route::get('manifest.json', [
    'as' => 'manifest',
    'uses' => 'PagesController@manifest',
]);

/*
 * Administration Pages
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', [
        'as' => 'index',
        'uses' => 'HomeController@index',
    ]);

    Route::get('mainservice', [
        'as' => 'mainservice',
        'uses' => 'HomeController@mainservice',
    ]);

    Route::get('songs', [
        'as' => 'songs',
        'uses' => 'HomeController@songs',
    ]);

    Route::get('read', [
        'as' => 'read',
        'uses' => 'HomeController@read',
    ]);

    Route::get('video', [
        'as' => 'video',
        'uses' => 'HomeController@video',
    ]);
});


// Settings Dashboard Routes...
Route::get('settings', 'Settings\DashboardController@show');


// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
