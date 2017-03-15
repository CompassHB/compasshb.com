<?php

namespace CompassHB\Www\Http\Controllers;

use Cache;
use Response;
use GuzzleHttp\Client;
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
//        $data['sermons'] = Sermon::where('ministryId', '=', null)
//                                ->published()
//                                ->orderBy('published_at', 'desc')
//                                ->limit(300)
//                                ->get();

        $client = new Client();
        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/posts', [
            'query' => [
                '_embed' => true,
                'categories' => 1,
                'per_page' => 500
            ]
        ])->getBody();

        $data['sermons'] = json_decode($body);

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
 //       $data['sermons'] = Sermon::where('ministryId', '=', null)->published()->orderBy('published_at', 'desc')->limit(300)->get();

        $client = new Client();
        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/posts', [
            'query' => [
                '_embed' => true,
                'categories' => 1,
                'per_page' => 500
            ]
        ])->getBody();

        $data['sermons'] = json_decode($body);

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
        $client = new Client();
        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/posts', [
            'query' => [
                '_embed' => true,
                'categories' => 1,
                'per_page' => 500
            ]
        ])->getBody();

        $data['sermons'] = json_decode($body);

        return Response::view('feeds.json', $data, 200, [
            'Content-Type' => 'application/json; charset=UTF-8',
        ]);
    }

    public function blog()
    {
//        $feed = new Feed();
//        $feed->make();
//        $feed->setCache(60);
//        if (!$feed->isCached()) {
//            $posts = DB::table('blogs')->orderBy('created_at', 'desc')->take(20)->get();
//
//            $feed->title = 'Compass HB Blog';
//            $feed->description = 'Compass Bible Church Huntington Beach Blog';
//            $feed->logo = 'https://pbs.twimg.com/profile_images/497102522255818752/EcsbtxPb.jpeg';
//            $feed->link = URL::to('feed/blog.xml');
//            $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
//            $feed->pubdate = $posts[0]->created_at;
//            $feed->lang = 'en';
//            $feed->setShortening(true); // true or false
//            $feed->setTextLimit(100); // maximum length of description text
//
//            foreach ($posts as $post) {
//                // set item's title, author, url, pubdate, description and content
//                $feed->add(
//                    $post->title,
//                    'Compass HB',
//                    URL::to($post->alias),
//                    $post->created_at,
//                    $post->body,
//                    $post->body
//                );
//            }
//        }
//
//        return $feed->render('atom');
        return ;
    }

    public function read()
    {
//        $feed = new Feed();
//        $feed->make();
//        $feed->setCache(60);
//        if (!$feed->isCached()) {
//            $posts = DB::table('passages')->orderBy('created_at', 'desc')->take(20)->get();
//
//            $feed->title = 'Compass HB Scripture of the Day';
//            $feed->description = 'Compass Bible Church Huntington Beach Scripture of the Day';
//            $feed->logo = 'https://pbs.twimg.com/profile_images/497102522255818752/EcsbtxPb.jpeg';
//            $feed->link = URL::to('feed/blog.xml');
//            $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
//            $feed->pubdate = $posts[0]->created_at;
//            $feed->lang = 'en';
//            $feed->setShortening(true); // true or false
//            $feed->setTextLimit(100); // maximum length of description text
//
//            foreach ($posts as $post) {
//                // set item's title, author, url, pubdate, description and content
//                $feed->add(
//                    $post->title,
//                    'Compass HB',
//                    URL::to($post->alias),
//                    $post->created_at,
//                    $post->body,
//                    $post->body
//                );
//            }
//        }
//
//        return $feed->render('atom');
        return;
    }
}
