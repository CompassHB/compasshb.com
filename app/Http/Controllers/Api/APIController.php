<?php

namespace CompassHB\Www\Http\Controllers\Api;

use Illuminate\Http\Request;
use CompassHB\Www\Sermon;
use CompassHB\Www\Http\Requests;
use CompassHB\Www\Contracts\Video;
use CompassHB\Www\Http\Controllers\Controller;

class APIController extends Controller
{
    public function index(Video $video)
    {
        $sermons = Sermon::where('ministry', '=', null)->latest('published_at')->published()->get();

        foreach ($sermons as $sermon) {
            $video->setUrl($sermon->video);
            $sermon->image = $video->getThumbnail();
        }

        return response()->json($sermons);
    }

    public function show(Sermon $sermon, Video $video)
    {
        $video->setUrl($sermon->video);
        $texttrack = $video->getTextTracks(true);
        $sermon->iframe = $video->getEmbedCode(true);
        $coverimage = $video->getThumbnail();
        $sermon->plays = $video->getVideoPlays();

        return response()->json($sermon);
    }}
