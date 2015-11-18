<?php

namespace CompassHB\Www\Http\Controllers;

use CompassHB\Www\Blog;
use CompassHB\Www\Song;
use CompassHB\Www\Sermon;
use CompassHB\Www\Series;
use CompassHB\Www\Passage;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Passage::since($this->user->last_login)
                    ->published()
                    ->latest('published_at')
                    ->get();

        return view('admin.home', compact('posts'))
            ->with('title', 'Admin');
    }

    public function mainservice()
    {
        $sermons = Sermon::where('ministry', '=', null)->latest('published_at')->paginate(15);
        $series = Series::where('ministry', '=', null)->paginate(15);
        $blogs = Blog::latest('published_at')->paginate(15);

        return view('admin.mainservice', compact('sermons', 'blogs', 'series'))
            ->with('title', 'Admin - Main Service');
    }

    public function songs()
    {
        $songs = Song::latest()->paginate(15);

        return view('admin.songs', compact('songs'))
            ->with('title', 'Admin - Songs');
    }

    public function read()
    {
        $passages = Passage::latest('published_at')->paginate(15);

        return view('admin.read', compact('passages'))
            ->with('title', 'Admin - Scripture of the Day');
    }

    /**
     * Controller for route to admin page for Sunday School ministry.
     *
     * @return [type] [description]
     */
    public function video()
    {
        $sermons = Sermon::whereNotNull('ministry')->latest('published_at')->paginate(15);
        $series = Series::whereNotNull('ministry')->paginate(15);

        return view('admin.video', compact('sermons', 'series'))
            ->with('title', 'Admin - Videos');
    }
}
