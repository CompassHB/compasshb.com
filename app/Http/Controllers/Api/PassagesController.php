<?php

namespace CompassHB\Www\Http\Controllers\Api;

use Response;
use CompassHB\Www\Passage;
use CompassHB\Www\Http\Controllers\Controller;
use CompassHB\Www\Repositories\Scripture\ScriptureRepository;

class PassagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ScriptureRepository $scripture)
    {
        $passages = Passage::latest('published_at')->published()->take(1)->get();
        $passage = $passages->first();
        $passage->verses = $scripture->getScripture($passage->title);
        $passage->audio = $scripture->getAudioScripture($passage->title);

        return Response::json($passage->toArray());
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
}
