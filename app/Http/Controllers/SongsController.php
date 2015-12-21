<?php

namespace CompassHB\Www\Http\Controllers;

use Auth;
use CompassHB\Www\Song;
use CompassHB\Www\Contracts\Plan;
use CompassHB\Www\Contracts\Video;
use CompassHB\Www\Http\Requests\SongRequest;

class SongsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit', 'update', 'create', 'store', 'destroy']]);
    }

    /**
     * Show all songs.
     *
     * @param Video $video
     * @param Plan $plan
     * @return \Illuminate\View\View
     */
    public function index(Video $video, Plan $plan)
    {
        $songs = Song::latest('published_at')->published()->get();

        foreach ($songs as $song) {
            $video->setUrl($song->video);
            $song->thumbnail = $video->getThumbnail();
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
    public function show(Song $song, Video $video)
    {
        $video->setUrl($song->video);
        $song->iframe = $video->getEmbedCode(true);
        $texttrack = $video->getTextTracks(true);

        return view('dashboard.songs.show', compact('song', 'texttrack'))
            ->with('title', $song->title);
    }

    /**
     * Edit an existing song.
     *
     * @param Song $song
     *
     * @return \Illuminate\View\View
     */
    public function edit(Song $song)
    {
        return view('admin.songs.edit', compact('song'))->with('title', 'Edit Song');
    }

    /**
     * Update a song.
     *
     * @param Song        $song
     * @param SongRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Song $song, SongRequest $request)
    {
        $song->update($request->all());

        return redirect()
            ->route('admin.songs')
            ->with('message', 'Success! Your song was updated.');
    }

    /**
     * Show the page to create a new song.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.songs.create');
    }

    /**
     * Store a new song.
     *
     * @param SongRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SongRequest $request)
    {
        $song = new Song($request->all());

        Auth::user()->songs()->save($song);

        return redirect()
            ->route('admin.songs')
            ->with('message', 'Success! Your song was saved.');
    }
}
