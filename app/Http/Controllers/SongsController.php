<?php

namespace CompassHB\Www\Http\Controllers;

use GuzzleHttp\Client;
use CompassHB\Www\Song;
use CompassHB\Www\Contracts\Plan;
use CompassHB\Www\Contracts\Video;

class SongsController extends Controller
{
    /**
     * Show all songs.
     *
     * @param Video $video
     * @param Plan $plan
     * @return \Illuminate\View\View
     */
    public function index(Video $video, Plan $plan)
    {
        $client = new Client();
        $body = $client->get('https://api.compasshb.com/worship/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true
            ]
        ])->getBody();

        $songs = json_decode($body);

        foreach ($songs as $song) {
            $video->setUrl($song->acf->video_url);
        }

        $setlist = $plan->getSetList();

        return view('dashboard.songs.index', compact(
            'songs',
            'setlist'
        ))->with('title', 'Worship Songs');
    }

    /**
     * Show a single song.
     *
     * @param Song $song
     *
     * @param Video $video
     * @return \Illuminate\View\View
     */
    public function show($song, Video $video)
    {
        $client = new Client();
        $body = $client->get('https://api.compasshb.com/worship/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'filter[name]' => $song
            ]
        ])->getBody();

        $song = json_decode($body);

        // Handle 404 if page does not exist in API
        if (empty($song))
        {
            abort(404);
        } else {
            $song = $song[0];
        }

        $video->setUrl($song->acf->video_url);
        $song->iframe = $video->getEmbedCode(true);
        $texttrack = $video->getTextTracks(true);

        return view('dashboard.songs.show', compact('song', 'texttrack'))
            ->with('title', $song->title->rendered);
    }

}
