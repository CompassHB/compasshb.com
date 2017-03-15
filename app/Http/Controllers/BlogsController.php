<?php

namespace CompassHB\Www\Http\Controllers;

use Auth;
use GuzzleHttp\Client;
use CompassHB\Www\Contracts\Video;

class BlogsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit', 'update', 'create', 'store', 'destroy']]);
    }

    /**
     * Show all blogs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $client = new Client();
        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'categories' => 12,
                'per_page' => 500
            ]
        ])->getBody();

        $blogs = json_decode($body);

        return view('dashboard.blogs.index', compact('blogs'))
            ->with('title', 'Blog');
    }

    /**
     * Show a single blog.
     *
     * @param Blog $blog
     *
     * @param Video $video
     * @param string $locale
     * @return \Illuminate\View\View
     */
    public function show($blog, Video $video, $locale = 'en')
    {
        $client = new Client();
        $body = $client->get('https://api.compasshb.com/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'slug' => $blog
            ]
        ])->getBody();

        $blog = json_decode($body);

        // Handle 404 if page does not exist in API
        if (empty($blog))
        {
            abort(404);
        } else {
            $blog = $blog[0];
        }

        $coverimage = $blog->_embedded->{'wp:featuredmedia'}[0]->source_url;

        return view('dashboard.blogs.show', compact('blog', 'coverimage'))
            ->with('title', $blog->title->rendered)->with('ogdescription', 'Compass Bible Church Huntington Beach');
    }

    public function language($blog, $locale, Video $video)
    {
        return $this->show($blog, $video, $locale);
    }
    
}
