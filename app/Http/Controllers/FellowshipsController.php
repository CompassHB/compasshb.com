<?php

namespace CompassHB\Www\Http\Controllers;

use CompassHB\Www\Sermon;
use CompassHB\Www\Contracts\Video;

class FellowshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Video $video
     * @param Events $event
     * @return \Illuminate\View\View
     */
    public function index(Video $video)
    {
        $sermon = Sermon::where('ministryId', '=', null)->latest('published_at')->published()->take(1)->get()->first();

        $video->setUrl($sermon->video);
        $sermon->iframe = $video->getEmbedCode();
        
        return view('dashboard.fellowships.index', compact('sermon'))
            ->with('title', 'Home Fellowship Groups');
    }

    public function show(Events $event, $id)
    {
        $event = $event->event($id);

        return view('dashboard.fellowships.show', compact('event'));
    }
}
