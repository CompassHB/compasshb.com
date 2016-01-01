<?php

namespace CompassHB\Www\Http\Controllers;

use CompassHB\Www\Sermon;
use CompassHB\Www\Contracts\Video;
use CompassHB\Www\Contracts\Events;

class FellowshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Video $video
     * @param Events $event
     * @return \Illuminate\View\View
     */
    public function index(Video $video, Events $event)
    {
        $sermon = Sermon::where('ministryId', '=', null)->latest('published_at')->published()->take(1)->get()->first();

        $video->setUrl($sermon->video);
        $sermon->iframe = $video->getEmbedCode();

        $e = $event->events();
        $hfg = [];

        $events = array_filter($e, function ($var) {
                // Filter out Home Fellowship Group events
                return ($var->organizer_id == '8215662871');
        });

        // Remove duplicates
        foreach (array_reverse($events) as $item) {
            if (isset($item->series_id)) {
                $hfg[$item->series_id] = $item;
            }
        }

        $hfg = array_reverse($hfg);

        $map = '';
        foreach ($hfg as $h) {
            //    $map .= '&markers=color:0x497F9B|'.$h->venue->latitude.','.$h->venue->longitude;
        }

        return view('dashboard.fellowships.index', compact('sermon', 'hfg', 'map'))
            ->with('title', 'Home Fellowship Groups');
    }

    public function show(Events $event, $id)
    {
        $event = $event->event($id);

        return view('dashboard.fellowships.show', compact('event'));
    }
}
