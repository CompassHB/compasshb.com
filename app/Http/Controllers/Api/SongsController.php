<?php

namespace CompassHB\Www\Http\Controllers\Api;

use Response;
use CompassHB\Www\Song;
use CompassHB\Www\Contracts\Video;
use CompassHB\Www\Http\Controllers\Controller;

class SongsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Video $video
     * @return Response
     */
    public function index(Video $video)
    {
        $songs = Song::latest('published_at')->published()->get();

        foreach ($songs as $song) {
            $video->setUrl($song->video);
            $song->thumbnail = $video->getThumbnail();
        }

        return Response::json($songs->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
