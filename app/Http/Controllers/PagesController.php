<?php

namespace CompassHB\Www\Http\Controllers;

use Log;
use Cache;
use GuzzleHttp\Client;
use CompassHB\Www\Song;
use CompassHB\Www\Series;
use CompassHB\Www\Sermon;
use CompassHB\Www\Contracts\Photos;
use CompassHB\Www\Contracts\Video;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Controller for the homepage.
     *
     * @param Photos $photos
     * @param Video $videoClient
     * @param Events $event
     * @return view
     */
    public function home(Photos $photos, Video $videoClient)
    {

        // Featured Events
        $client = new Client();

        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/tribe_events', [
            'query' => [
                '_embed' => true
            ]
        ])->getBody();

        $featuredevents = json_decode($body);
        $featuredevents = array_reverse($featuredevents);

        $sermons = Sermon::where('ministryId', '=', null)->latest('published_at')->published()->take(4)->get();
        $prevsermon = $sermons->first();
        $nextsermon = Sermon::unpublished()->get();

        // get two videos
        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'filter[cat]' => 12,
                'per_page' => 4
            ]
        ])->getBody();

        $videos = json_decode($body);

        // get single passages
        $body = $client->get('http://api.compasshb.com/reading/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true
            ]
        ])->getBody();

        $passage = json_decode($body);
        $passage = $passage[0];

        foreach ($sermons as $sermon) {
            $videoClient->setUrl($sermon->video);
            $sermon->othumbnail = $videoClient->getThumbnail();
        }

        if ($prevsermon) {
            $videoClient->setUrl($prevsermon->video);
            $prevsermon->othumbnail = $videoClient->getThumbnail();
            $prevsermon->plays = $videoClient->getVideoPlays();
        } else {
            $prevsermon = (object) [
                'title' => '{{Sermon title here}}',
                'slug' => 'sermon-slug-here',
                'othumbnail' => 'https://dummyimage.com/600x400/000/fff.jpg',
                'series' => (object) [
                    'title' => '{{Series title here}}',
                ],
            ];
        }

        /*
         * Instagram
         * @todo Move caching out of controller
         */
        $url = 'https://api.instagram.com/v1/users/1363574956/media/recent/?count=4&client_id='.
            env('INSTAGRAM_CLIENT_ID');
        try {
            $instagrams = Cache::remember('instagrams', '180', function () use ($url) {
                return json_decode(file_get_contents($url), true);
            });
        } catch (\Exception $e) {
            Log::warning('Connection refused to api.instagram.com');
            $instagrams['data'] = [];
        }

        /*Pages
         * Smugmug
         */
        $results = $photos->getPhotos(8);

        $broadcast = Cache::get('broadcast');

        return view('pages.index', compact(
            'broadcast',
            'sermons',
            'featuredevents',
            'nextsermon',
            'prevsermon',
            'videos',
            'passage'
        ))->with('images', $results)
            ->with('instagrams', $instagrams['data'])
            ->with('title', 'Compass HB - Huntington Beach');
    }

    /**
     * Populate the Photos page from Photo Client.
     *
     * @param Photos $photos
     * @return \Illuminate\View\View
     */
    public function photos(Photos $photos)
    {
        $results = $photos->getRecentPhotos();

        return view('pages.photos')
            ->with('title', 'Photography')
            ->with('photos', $results);
    }

    public function pray()
    {
        return view('dashboard.pray.index')
            ->with('title', 'Pray');
    }

    public function whoweare()
    {
        return view('pages.whoweare')
            ->with('title', 'Who We Are');
    }

    public function eightdistinctives()
    {
        return view('pages.eightdistinctives')
            ->with('title', '8 Distinctives');
    }

    public function give()
    {
        return redirect('giving');
    }

    public function giving()
    {
        return view('pages.give')
            ->with('title', 'Give');
    }

    public function icecreamevangelism()
    {
        return view('pages.icecreamevangelism')
            ->with('title', 'Ice Cream Evangelism');
    }

    public function whatwebelieve()
    {
        return view('pages.whatwebelieve')
            ->with('title', 'What We Believe');
    }


    public function goodytwoshoes()
    {
        return view('pages.goodytwoshoes')
            ->with('title', 'Goody Two Shoes');
    }

    public function manifest()
    {
        return view('feeds.manifest');
    }

    public function bunnyrun()
    {
        return redirect('https://www.compasshb.com/events/22334601394/bunny-run-and-chase/');
    }

    public function greatawakening()
    {
        $client = new Client();
        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/pages', [
            'query' => ['filter[name]' => 'greatawakening']
        ])->getBody();

        $page = json_decode($body);
        $page = $page[0];
        
        return view('dashboard.landing.show', compact('page'));
    }

    public function resurrectionweek()
    {
        return redirect('https://www.compasshb.com/events/22662635553/resurrection-week/');
    }

        public function sitemap(Video $video)
    {
//        $blogs = Blog::published()->get();
        $sermons = Sermon::published()->get();
//        $passages = Passage::pluck('alias');
            $passages = [];
        $series = Series::pluck('alias');
        $songs = Song::pluck('alias');
//        $events = $event->events();
            $events = [];

        // Generate video thumbnails
        foreach ($sermons as $sermon) {
            if (isset($sermon->video)) {
                $video->setUrl($sermon->video);
                $sermon->image = $video->getThumbnail();
            }
        }

        // Keep only Home Fellowship Group events
        $fellowships = [];

        return response()
            ->view('pages.sitemap', compact('sermons', 'passages', 'series', 'songs', 'events', 'fellowships'))
            ->header('Content-Type', 'application/xml');
    }

    public function eventsindex()
    {

        $client = new Client();

         $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/tribe_events', [
                'query' => [
                    '_embed' => true
                ]
            ])->getBody();

            $events = json_decode($body);
            $events = array_reverse($events);


            return view('dashboard.events.index', compact('events'));
    }

    public function eventsshow($event) {

        $client = new Client();
            $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/tribe_events', [
                'query' => [
                    '_embed' => true,
                    'filter[name]' => $event,

                ]
            ])->getBody();

            $events = json_decode($body);

            // Handle 404 if event does not exist in API
            if (empty($event))
            {
                abort(404);
            } else {
                $events = $events[0];
            }

            return view('dashboard.events.show', compact('events'));

        }
    

    public function search()
    {
        return redirect()->route('home');
    }

    /**
     * Clear the video cache when video management system sends a webhook callback.
     * @param $auth
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function clearvideothumbcache($auth)
    {
        if ($auth == env('EVENTBRITE_CALLBACK')) {
            $latestsermon = Sermon::where('ministryId', '=', null)->latest('published_at')->published()->get()->first();
            Cache::forget($latestsermon->video);
        }

        return redirect(
            'https://developers.facebook.com/tools/debug/og/object?q=https://www.compasshb.com/sermons/'.
            $latestsermon->alias
        );
    }
}
