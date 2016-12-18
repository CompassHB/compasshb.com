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
                'per_page' => 100
            ]
        ])->getBody();

        $sermons = json_decode($body);

        // page 2 hack
        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/posts', [
            'query' => [
                '_embed' => true,
                'filter[cat]' => 1,
                'per_page' => 100,
                'page' => 2
            ]
        ])->getBody();

        $sermons2 = json_decode($body);

        return view('dashboard.sermons.index', compact('sermons', 'sermons2'));
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

        $coverimage = $sermon->_embedded->{'wp:featuredmedia'}[0]->source_url;

        return view(
            'dashboard.sermons.show',
            compact('sermon', 'coverimage', 'texttrack', 'plays')
        )
            ->with('title', strip_tags($sermon->title->rendered))
            ->with('ogdescription', strip_tags($sermon->excerpt->rendered) . ' - Compass Bible Church Huntington Beach');
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
