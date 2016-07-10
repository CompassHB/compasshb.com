<?php

namespace CompassHB\Www\Http\Controllers;

use Auth;
use GuzzleHttp\Client;
use CompassHB\Www\Contracts\Analytics;
use CompassHB\Www\Contracts\Scripture;
use CompassHB\Www\Http\Requests\PassageRequest;

class PassagesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    protected $analytics;
    protected $scripture;

    public function __construct(Analytics $analytics, Scripture $scripture)
    {
        $this->analytics = $analytics;
        $this->scripture = $scripture;
        $this->middleware('auth', ['only' => ['edit', 'update', 'create', 'store', 'destroy']]);
    }

    /**
     * Show index/today's passage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // get single passages
        $client = new Client();
        $body = $client->get('http://api.compasshb.com/reading/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true
            ]
        ])->getBody();

        $passage = json_decode($body);
        $passage = $passage[0];
        
        return $this->show($passage->slug, true);
    }

    /**
     * Show a single passage.
     *
     * @param Passage $passage
     *
     * @param bool $today
     * @return \Illuminate\View\View
     */
    public function show($passage, $today = false)
    {
        // get single passages
        $client = new Client();
        $body = $client->get('http://api.compasshb.com/reading/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'filter[name]' => $passage
            ]
        ])->getBody();

        $passage = json_decode($body);

        // Handle 404 if page does not exist in API
        if (empty($passage)) {
            abort(404);
        } else {
            $passage = $passage[0];
        }

        // For sidebar display
        $body = $client->get('http://api.compasshb.com/reading/wp-json/wp/v2/posts?embed', [
            'query' => [
                'filter[per_page]' => 5
            ]
        ])->getBody();

        $passages = json_decode($body);

        // For social sharing
        // @TODO: edit after Bible Overview
        $coverimage = 'https://compasshb.smugmug.com/photos/i-w6dnZK2/0/S/i-w6dnZK2-S.jpg';
        $ogdescription = 'Read one chapter a day of every book of the Bible along with us.';

        $date = strtotime($passage->date);

        $analytics = $this->analytics->getPageViews(
            '/read',
            date('Y-m-d', $date),
            date('Y-m-d', $date)
        );
        $analytics['activeUsers'] = $this->analytics->getActiveUsers();

        $passage->verses = $this->scripture->getScripture($passage->title->rendered);
        $passage->audio = $this->scripture->getAudioScripture($passage->title->rendered);

        if ($today || date('Y-m-d') == date('Y-m-d', $date)) {
            $postflash = '';
            if ((date('D') == 'Sun' || date('D') == 'Sat') && date('Y-m-d') != date('Y-m-d', $date)) {
                $postflash = '<div class="alert alert-info" role="alert">Scripture of the Day is posted Monday through Friday.</div>';
            }
        } else {
            $postflash = '<div class="alert alert-info" role="alert"><strong>New Post!</strong> You are reading an old post. For today\'s, <a href="/read">click here.</a></div>';
        }

        return view('dashboard.passages.show', compact('passage', 'passages', 'postflash', 'analytics', 'coverimage', 'ogdescription'))
            ->with('title', $passage->title->rendered . ' - Bible Overview');
    }
}