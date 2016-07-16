<?php

namespace CompassHB\Www\Http\Controllers;

use Auth;
use Input;
use Request;
use GuzzleHttp\Client;
use CompassHB\Www\Series;
use CompassHB\Www\Sermon;
use CompassHB\Www\Http\Requests\SermonRequest;
use CompassHB\Www\Contracts\Video;
use CompassHB\Www\Contracts\Upload;

class SermonsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit', 'update', 'create', 'store', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Video $video
     * @return \Illuminate\View\View
     */
    public function index(Video $video)
    {
        $client = new Client();
        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/posts', [
            'query' => [
                '_embed' => true,
                'filter[cat]' => 1,
                'filter[posts_per_page]' => 500
            ]
        ])->getBody();

        $sermons = json_decode($body);

        return view('dashboard.sermons.index', compact('sermons'));
    }

    /**
     * Display the specified resource.
     *
     *
     * @param Sermon $sermon
     * @param Video $video
     * @return \Illuminate\View\View
     */
    public function show($sermon, Video $video)
    {
        $client = new Client();
        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/posts', [
            'query' => [
                '_embed' => true,
                'filter[name]' => $sermon
            ]
        ])->getBody();

        $sermon = json_decode($body);

        // Handle 404 if page does not exist in API
        if (empty($sermon))
        {
            abort(404);
        } else {
            $sermon = $sermon[0];
        }

        return view(
            'dashboard.sermons.show',
            compact('sermon', 'coverimage', 'texttrack', 'plays')
        )
            ->with('title', $sermon->title->rendered)
            ->with('ogdescription', $sermon->excerpt->rendered);
    }

    /**
     * Redirect to sermon download link.
     *
     * @param Sermon $sermon
     * @param Video $video
     * @return \Illuminate\Http\RedirectResponse
     * @internal param $Sermon
     */
    public function download(Sermon $sermon, Video $video)
    {
        $video->setUrl($sermon->video);

        return redirect()->to($video->getDownloadLink());
    }

    public function downloadmp4()
    {
        $url = Request::url();
        $redirect = substr($url, 0, strlen($url) -4);

        return redirect()->to($redirect);
    }
}
