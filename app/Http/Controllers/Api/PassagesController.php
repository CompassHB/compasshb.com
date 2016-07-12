<?php

namespace CompassHB\Www\Http\Controllers\Api;

use Response;
use GuzzleHTTP\Client;
use CompassHB\Www\Http\Controllers\Controller;
use CompassHB\Www\Contracts\Scripture;

class PassagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Scripture $scripture
     * @return Response
     */
    public function index(Scripture $scripture)
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

        $passage->verses = $scripture->getScripture($passage->title->rendered);
        $passage->audio = $scripture->getAudioScripture($passage->title->rendered);

        return Response::json($passage);
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
