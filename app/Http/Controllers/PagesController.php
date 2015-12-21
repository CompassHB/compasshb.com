<?php

namespace CompassHB\Www\Http\Controllers;

use Log;
use Cache;
use CompassHB\Www\Blog;
use CompassHB\Www\Song;
use CompassHB\Www\Series;
use CompassHB\Www\Sermon;
use CompassHB\Www\Passage;
use CompassHB\Www\Contracts\Photos;
use CompassHB\Www\Contracts\Video;
use CompassHB\Www\Contracts\Events;

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
    public function home(Photos $photos, Video $videoClient, Events $event)
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

        $sermons = Sermon::where('ministry', '=', null)->latest('published_at')->published()->take(4)->get();
        $prevsermon = $sermons->first();
        $nextsermon = Sermon::unpublished()->get();

        $blogs = Blog::latest('published_at')->published()->take(2)->get();
        $videos = Blog::whereNotNull('video')->latest('published_at')->published()->take(2)->get();
        $passage = Passage::latest('published_at')->published()->take(1)->get()->first();

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

    public function manifest()
    {
        return view('feeds.manifest');
    }

    public function sitemap(Video $video, Events $event)
    {
        $blogs = Blog::published()->get();
        $sermons = Sermon::published()->get();
        $passages = Passage::pluck('slug');
        $series = Series::pluck('slug');
        $songs = Song::pluck('slug');
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

    public function events(Events $event, $id = null)
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
     * @param $auth
     * @param Events $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cleareventcache($auth, Events $event)
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

    public function search()
    {
        return redirect()->route('home');
    }

    /**
     * Clear the event cache when event management system sends a webhook callback.
     * @param $auth
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function clearvideothumbcache($auth)
    {
        if ($auth == env('EVENTBRITE_CALLBACK')) {
            $latestsermon = Sermon::where('ministry', '=', null)->latest('published_at')->published()->get()->first();
            Cache::forget($latestsermon->video);
        }

        return redirect(
            'https://developers.facebook.com/tools/debug/og/object?q=https://www.compasshb.com/sermons/'.
            $latestsermon->slug
        );
    }
}
