<?php

namespace CompassHB\Www\Http\Controllers;

use Auth;
use CompassHB\Www\Blog;
use CompassHB\Www\Contracts\Video;
use CompassHB\Www\Http\Requests\BlogRequest;

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
        $blogs = Blog::latest('published_at')->published()->get();

        return view('dashboard.blogs.index', compact('blogs'))
            ->with('title', 'Blog');
    }

    /**
     * Show a single blog.
     *
     * @param Blog $blog
     *
     * @return \Illuminate\View\View
     */
    public function show(Blog $blog, Video $video, $locale = 'en')
    {
        $languages = [];
        $blog->iframe = '';
        $texttrack = '';

        if (!empty($blog->video)) {
            $video->setUrl($blog->video);

            $blog->iframe = $video->getEmbedCode(true);
            $coverimage = $video->getThumbnail();

            $languages = $video->getLanguages();

            // SHow the english if requested
            // locale not supported
            if (!in_array($locale, $languages) && $locale != 'en') {
                return redirect('/blog/'.$blog->slug);
            }

            $texttrack = $video->getTextTracks(true, $locale);
        }

        return view(
            'dashboard.blogs.show',
            compact(
                'blog',
                'coverimage',
                'texttrack',
                'languages'
            )
        )->with('title', $blog->title)->with('ogdescription', 'Compass Bible Church Huntington Beach');
    }

    public function language(Blog $blog, Video $video, $locale)
    {
        return $this->show($blog, $video, $locale);
    }

    /**
     * Edit an existing blog.
     *
     * @param Blog $blog
     *
     * @return \Illuminate\View\View
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update a blog.
     *
     * @param Blog        $blog
     * @param BlogRequest $request
     *
     * @return Response
     */
    public function update(Blog $blog, BlogRequest $request)
    {
        $blog->update($request->all());

        return redirect()
            ->route('admin.index')
            ->with('message', 'Success! Your blog was updated.');
    }

    /**
     * Show the page to create a new blog.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a new blog.
     *
     * @param BlogRequest $request
     *
     * @return Response
     */
    public function store(BlogRequest $request)
    {
        $blog = new Blog($request->all());

        Auth::user()->blogs()->save($blog);

        return redirect()
            ->route('admin.index')
            ->with('message', 'Success! Your blog was saved.');
    }
}
