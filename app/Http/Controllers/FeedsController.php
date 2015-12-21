<?php

namespace CompassHB\Www\Http\Controllers;

use DB;
use URL;
use Cache;
use Response;
use Roumen\Feed\Feed;
use CompassHB\Www\Sermon;
use CompassHB\Www\Contracts\Video;

class FeedsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Feed to podcasting and RSS.
     *
     * @return \Illuminate\View\View
     */
    public function sermons()
    {
        $data = array();
        $data['sermons'] = Sermon::where('ministry', '=', null)
                                ->published()
                                ->orderBy('published_at', 'desc')
                                ->limit(300)
                                ->get();

        return Response::view('podcasts.video', $data, 200, [
            'Content-Type' => 'application/atom+xml; charset=UTF-8',
        ]);
    }

    /**
     * Audio sermon podcast feed.
     *
     * @return \Illuminate\View\View
     */
    public function sermonaudio()
    {
        $data['sermons'] = Sermon::where('ministry', '=', null)->published()->orderBy('published_at', 'desc')->limit(300)->get();

        return Response::view('podcasts.audio', $data, 200, [
            'Content-Type' => 'application/atom+xml; charset=UTF-8',
        ]);
    }

    /**
     * Feed to mobile app.
     *
     * @param Video $video
     * @return \Illuminate\View\View
     */
    public function json(Video $video)
    {
        $data = array();
        $data['sermons'] = Sermon::where('ministry', '=', null)->orderBy('published_at', 'desc')->published()->limit(300)->get();

        // Retrieve coverart
        foreach ($data['sermons'] as $sermon) {
            if (!Cache::has($sermon->video)) {
                $video->setUrl($sermon->video);
                Cache::add($sermon->video, $video->getThumbnail(), 1440);
            }

            $sermon->othumbnail = Cache::get($sermon->video);
            $sermon->date = $sermon->published_at->format('F, j Y');
        }

        return Response::view('feeds.json', $data, 200, [
            'Content-Type' => 'application/json; charset=UTF-8',
        ]);
    }

    public function blog()
    {
        $feed = new Feed();
        $feed->make();
        $feed->setCache(60);
        if (!$feed->isCached()) {
            $posts = DB::table('blogs')->orderBy('created_at', 'desc')->take(20)->get();

            $feed->title = 'Compass HB Blog';
            $feed->description = 'Compass Bible Church Huntington Beach Blog';
            $feed->logo = 'https://pbs.twimg.com/profile_images/497102522255818752/EcsbtxPb.jpeg';
            $feed->link = URL::to('feed/blog.xml');
            $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
            $feed->pubdate = $posts[0]->created_at;
            $feed->lang = 'en';
            $feed->setShortening(true); // true or false
            $feed->setTextLimit(100); // maximum length of description text

            foreach ($posts as $post) {
                // set item's title, author, url, pubdate, description and content
                $feed->add(
                    $post->title,
                    'Compass HB',
                    URL::to($post->slug),
                    $post->created_at,
                    $post->body,
                    $post->body
                );
            }
        }

        return $feed->render('atom');
    }

    public function read()
    {
        $feed = new Feed();
        $feed->make();
        $feed->setCache(60);
        if (!$feed->isCached()) {
            $posts = DB::table('passages')->orderBy('created_at', 'desc')->take(20)->get();

            $feed->title = 'Compass HB Scripture of the Day';
            $feed->description = 'Compass Bible Church Huntington Beach Scripture of the Day';
            $feed->logo = 'https://pbs.twimg.com/profile_images/497102522255818752/EcsbtxPb.jpeg';
            $feed->link = URL::to('feed/blog.xml');
            $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
            $feed->pubdate = $posts[0]->created_at;
            $feed->lang = 'en';
            $feed->setShortening(true); // true or false
            $feed->setTextLimit(100); // maximum length of description text

            foreach ($posts as $post) {
                // set item's title, author, url, pubdate, description and content
                $feed->add(
                    $post->title,
                    'Compass HB',
                    URL::to($post->slug),
                    $post->created_at,
                    $post->body,
                    $post->body
                );
            }
        }

        return $feed->render('atom');
    }
}
