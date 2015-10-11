<?php

namespace CompassHB\Www\Http\Controllers;

use Log;
use Cache;
use Carbon\Carbon;
use GuzzleHttp;
use Request;
use CompassHB\Www\Blog;
use CompassHB\Www\Song;
use CompassHB\Www\Series;
use CompassHB\Www\Sermon;
use CompassHB\Www\Passage;
use CompassHB\Www\Repositories\Video\VideoRepository;
use CompassHB\Www\Repositories\Photo\PhotoRepository;
use CompassHB\Www\Repositories\Event\EventRepository;
use CompassHB\Www\Repositories\Search\SearchRepository;

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
     * @return view
     */
    public function home(PhotoRepository $photos, VideoRepository $videoClient, EventRepository $event)
    {
        $featuredevents = $event->search('#featuredevent');
        $featuredevents = $featuredevents->events;

        $fevents = [];
        // Remove duplicates/recurring events
        foreach ($featuredevents as $item) {
            if (isset($item->series_id)) {
                if (!isset($fevents[$item->series_id])) {
                    $fevents[$item->series_id] = $item;
                }
            } else {
                $fevents[$item->id] = $item;
            }
        }

        $sermons = Sermon::where('ministry', '=', null)->latest('published_at')->published()->take(3)->get();
        $prevsermon = $sermons->first();
        $nextsermon = Sermon::unpublished()->get();

        $blogs = Blog::latest('published_at')->published()->take(2)->get();
        $videos = Blog::whereNotNull('video')->latest('published_at')->published()->take(2)->get();
        $passage = Passage::latest('published_at')->published()->take(1)->get()->first();

        $distinctives = [
            ['text' => '1. The Bible is Central', 'icon' => 'glyphicon-book'],
            ['text' => '2. We showcase expository preaching', 'icon' => 'glyphicon-cog'],
            ['text' => '3. We seek to maintain a high view of God', 'icon' => 'glyphicon-picture'],
            ['text' => '4. We work to proclaim a biblical gospel', 'icon' => 'glyphicon-bullhorn'],
            ['text' => '5. We have a genuine reliance on prayer', 'icon' => 'glyphicon-cloud-upload'],
            ['text' => '6. We have highly committed participants', 'icon' => 'glyphicon-user'],
            ['text' => '7. We will look to authentic & sacrificial leaders', 'icon' => 'glyphicon-ok'],
            ['text' => '8. We will always be working to plant new churches', 'icon' => 'glyphicon-globe'],
        ];
        shuffle($distinctives);

        foreach ($sermons as $sermon) {
            $videoClient->setUrl($sermon->video);
            $sermon->othumbnail = $videoClient->getThumbnail();
        }

        foreach ($videos as $video) {
            $videoClient->setUrl($video->video);
            $video->othumbnail = $videoClient->getThumbnail();
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
        $url = 'https://api.instagram.com/v1/users/1363574956/media/recent/?count=4&client_id='.env('INSTAGRAM_CLIENT_ID');
        try {
            $instagrams = Cache::remember('instagrams', '180', function () use ($url) {
                return json_decode(file_get_contents($url), true);
            });
        } catch (\Exception $e) {
            Log::warning('Connection refused to api.instagram.com');
            $instagrams['data'] = [];
        }

        /*
         * Smugmug
         */
        $results = $photos->getPhotos(8);

        $broadcast = Cache::get('broadcast');

        return view('pages.index', compact(
            'broadcast',
            'sermons',
            'fevents',
            'nextsermon',
            'prevsermon',
            'blogs',
            'videos',
            'passage',
            'distinctives'
        ))->with('images', $results)
            ->with('instagrams', $instagrams['data'])
            ->with('title', 'Compass HB - Huntington Beach');
    }

    /**
     * Populate the Photos page from Photo Client.
     *
     * @return \Illuminate\View\View
     */
    public function photos(PhotoRepository $photos)
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

    public function manifest()
    {
        return view('feeds.manifest');
    }

    public function search(SearchRepository $search)
    {
        $results = ['hits' => ['hits' => []]];

        $query = Request::get('q');

        if (isset($query)) {
            $results = $search->search($query);
        }

        return view('dashboard.search.index', compact('results', 'query'));
    }

    public function sitemap(VideoRepository $video, EventRepository $event)
    {
        $blogs = Blog::published()->get();
        $sermons = Sermon::published()->get();
        $passages = Passage::lists('slug');
        $series = Series::lists('slug');
        $songs = Song::lists('slug');
        $events = $event->events();

        // Generate video thumbnails
        foreach ($sermons as $sermon) {
            if (isset($sermon->video)) {
                $video->setUrl($sermon->video);
                $sermon->image = $video->getThumbnail();
            }
        }

        foreach ($blogs as $blog) {
            if (isset($blog->video)) {
                $video->setUrl($blog->video);
                $blog->image = $video->getThumbnail();
            }
        }

        // Keep only Home Fellowship Group events
        $fellowships = array_filter($events, function ($var) {
            return ($var->organizer_id == '8215662871');
        });

        return response()
            ->view('pages.sitemap', compact('sermons', 'blogs', 'passages', 'series', 'songs', 'events', 'fellowships'))
            ->header('Content-Type', 'application/xml');
    }

    public function events(EventRepository $event, $id = null)
    {
        if ($id) {

            // Single Event Page
            $event = $event->event($id);

            return view('dashboard.events.show', compact('event'));
        } else {

            // All Events
            $events = $event->events();

            // Filter out Home Fellowship Group events
            $events = array_filter($events, function ($var) {
                return ($var->organizer_id != '8215662871');
            });

            // Events accepting registrations
            $registrations = array_filter($events, function ($var) {

                // If the ticket is not hidden or it has the hashtag #registrations
                // return (!$var->ticket_classes[0]->hidden ||
                //        strpos($var->description->text, '#registration'));
            });

            return view('dashboard.events.index', compact('events', 'registrations'));
        }
    }

    /**
     * Clear the event cache when event management system sends a webhook callback.
     */
    public function cleareventcache($auth, EventRepository $event)
    {
        if ($auth == env('EVENTBRITE_CALLBACK')) {
            Cache::forget('searchevent');
            Cache::forget('events');

            // Warm the cache
            $event->events();
            $event->search('#featuredevents');
        }

        return redirect()
            ->route('home');
    }

    public function live()
    {
        return view('pages.live');
    }
}
