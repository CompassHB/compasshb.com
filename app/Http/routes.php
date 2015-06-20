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
Route::get('sermons/{sermons}/download', [
    'as' => 'sermons.download',
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
 * Routes for feeds
 */
Route::group(['prefix' => 'feed', 'as' => 'feed.'], function () {

    Route::get('sermons',  [
        'as' => 'sermons',
        'uses' => 'FeedsController@sermons',
    ]);

    Route::get('sermonaudio',  [
        'as' => 'sermonaudio',
        'uses' => 'FeedsController@sermonaudio',
    ]);

    Route::get('sermons.json',  [
        'middleware' => 'cors',
        'as' => 'sermons.json',
        'uses' => 'FeedsController@json',
    ]);

    Route::get('songs.xml', [
        'as' => 'songs.xml',
        'uses' => 'FeedsController@songs',
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
});

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
 * Routes for landing pages
 */
Route::get('bunnyrun', [
    'as' => 'bunnyrun',
    'uses' => 'PagesController@bunnyrun',
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

Route::get('search/{q}', [
    'as' => 'search',
    'uses' => 'PagesController@search',
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

    Route::get('sundayschool', [
        'as' => 'sundayschool',
        'uses' => 'HomeController@sundayschool',
    ]);

});

/*
 * Authentication
 */
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
