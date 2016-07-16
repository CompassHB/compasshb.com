<?php

namespace CompassHB\Www\Http\Controllers;

use Auth;
use GuzzleHttp\Client;
use CompassHB\Www\Series;
use CompassHB\Www\Contracts\Video;

class SeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit', 'update', 'create', 'store', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $client = new Client();
        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/tags?embed')->getBody();

        $series = array_reverse(json_decode($body));

        return view('dashboard.series.index', compact('series'))
            ->with('title', 'Sermon Series');
    }

    /**
     * Display the specified resource.
     *
     *
     * @param Series $series
     * @param Video $video
     * @return \Illuminate\View\View
     */
    public function show($item, Video $video)
    {
        $client = new Client();
        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/tags', [
            'query' => [
                'slug' => $item
            ]
        ])->getBody();

        $series = json_decode($body);

        // Handle 404 if page does not exist in API
        if (empty($series))
        {
            abort(404);
        } else {
            $series = $series[0];
        }

        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/posts', [
            'query' => [
                '_embed' => true,
                'filter[cat]' => 1,
                'tags' => $series->id
            ]
        ])->getBody();

        $sermons = json_decode($body);

        return view('dashboard.series.show', compact('series', 'sermons'))
            ->with('title', $series->name);
    }
}
