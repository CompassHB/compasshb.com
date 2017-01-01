<?php

/*
 * Route for songs.
 */
Route::get('songs', [
    'as' => 'songs.index',
    'uses' => 'SongsController@index'
]);

Route::get('songs/{song}', [
    'as' => 'songs.show',
    'uses' => 'SongsController@show'
]);

/*
 * Route for passages
 */
Route::get('read', [
    'as' => 'read.index',
    'uses' => 'PassagesController@index'
]);

Route::get('read/{passage}', [
    'as' => 'read.show',
    'uses' => 'PassagesController@show'
]);


/*
 * Route for sermons
 */
Route::get('sermons', [
    'as' => 'sermons.index',
    'uses' => 'SermonsController@index'
]);

Route::get('sermons/{sermon}', [
    'as' => 'sermons.show',
    'uses' => 'SermonsController@show'
]);
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
Route::get('series', [
    'as' => 'series.index',
    'uses' => 'SeriesController@index'
]);

Route::get('series/{item}', [
    'as' => 'series.show',
    'uses' => 'SeriesController@show'
]);

/*
 * Route for blogs
 */
Route::get('blog', [
    'as' => 'blog.index',
    'uses' => 'BlogsController@index'
]);

Route::get('blog/{blog}', [
    'as' => 'blog.show',
    'uses' => 'BlogsController@show'
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

Route::get('sotd', [
    'as' => 'sotd',
    'uses' => 'PagesController@sotd',
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

// Events
Route::get('events/', [
    'as' => 'events.index',
    'uses' => 'PagesController@eventsindex',
]);
Route::get('events/{event}', [
    'as' => 'events.show',
    'uses' => 'PagesController@eventsshow',
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

Route::get('youth/sermons/{sermon}', [
    'as' => 'youthsermon',
    'uses' => 'MinistryController@youthsermon',
]);

/*
 * Route for Sunday School ministry
 */
Route::get('sundayschool', [
    'as' => 'sundayschool',
    'uses' => 'MinistryController@sundayschool',
]);
Route::get('sundayschool/messages/{sermon}', [
    'as' => 'sundayschoolsermon',
    'uses' => 'MinistryController@sundayschoolsermon',
]);
Route::get('sundayschool/series/{item}', [
    'as' => 'sundayschoolseries',
    'uses' => 'SeriesController@showsundayschool',
]);

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
Route::get('men/sermons/{sermon}', [
    'as' => 'mensermon',
    'uses' => 'MinistryController@mensermon',
]);

/*
 * Route for women
 */
Route::get('women', [
    'as' => 'women',
    'uses' => 'MinistryController@women',
]);
Route::get('women/messages/{message}', [
    'as' => 'womenmessage',
    'uses' => 'MinistryController@womenmessage',
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
Route::get('greatawakening', ['as' => 'greatawakening',
    'uses' => 'PagesController@greatawakening',
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

Route::get('admin', [
    'as' => 'admin.index',
    'uses' => 'PagesController@admin'
]);
