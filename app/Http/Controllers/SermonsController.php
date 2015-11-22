<?php

namespace CompassHB\Www\Http\Controllers;

use Auth;
use Input;
use Request;
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
     * @return \Illuminate\View\View
     */
    public function index(Video $video)
    {
        $sermons = Sermon::where('ministry', '=', null)->latest('published_at')->published()->get();

        foreach ($sermons as $sermon) {
            $video->setUrl($sermon->video);
            $sermon->image = $video->getThumbnail();
        }

        return view('dashboard.sermons.index', compact('sermons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $series = Series::lists('title', 'id')->all();
        array_unshift($series, 'No Series');

        return view('admin.sermons.create')
            ->with('series', $series);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Cloud
     * @param SermonRequest
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SermonRequest $request, Upload $upload)
    {
        $sermon = new Sermon($request->all());
        $worksheet = Input::file('worksheet');
        $bulletin = Input::file('bulletin');

        // Save worksheet if one was uploaded
        if ($worksheet !== null) {
            $sermon->worksheet = $upload->uploadAndSaveS3(\Input::file('worksheet'), 'worksheets');
        }

        // Save bulletin if one was uploaded
        if ($bulletin !== null) {
            $sermon->bulletin = $upload->uploadAndSaveS3(\Input::file('bulletin'), 'bulletins');
        }

        Auth::user()->sermons()->save($sermon);

        return redirect()
            ->route('admin.index');
    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\View\View
     */
    public function show(Sermon $sermon, Video $video)
    {
        // Reserve /sermon URL for main service
        if (substr(Request::path(), 0, 8) === 'sermons/' &&
            $sermon->ministry !== null) {
            return redirect('/videos/'.$sermon->slug);
        }

        $video->setUrl($sermon->video);
        $texttrack = $video->getTextTracks(true);
        $sermon->iframe = $video->getEmbedCode(true);
        $coverimage = $video->getThumbnail();
        $sermon->plays = $video->getVideoPlays();

        return view('dashboard.sermons.show',
            compact('sermon', 'coverimage', 'texttrack', 'plays'))
            ->with('title', $sermon->title)
            ->with('ogdescription', $sermon->excerpt);
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return \Illuminate\View\View
     */
    public function edit(Sermon $sermon)
    {
        $series = Series::lists('title', 'id')->all();
        array_unshift($series, 'No Series');

        return view('admin.sermons.edit', compact('sermon'))
            ->with('series', $series);
    }

    /**
     * Update the specified resource in storage.
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Sermon $sermon, SermonRequest $request, Upload $upload)
    {
        $worksheet = Input::file('worksheet');
        $bulletin = Input::file('bulletin');
        $all = $request->all();

        // Replace worksheet if one was uploaded
        if ($worksheet !== null) {
            $all['worksheet'] = $upload->uploadAndSaveS3(\Input::file('worksheet'), 'worksheets');
        }

        // Replace worksheet if one was uploaded
        if ($bulletin !== null) {
            $all['bulletin'] = $upload->uploadAndSaveS3(\Input::file('bulletin'), 'bulletins');
        }

        $sermon->update($all);

        return redirect()
            ->route('admin.index')
            ->with('message', 'Success! Your sermon was updated.');
    }

    /**
     * Redirect to sermon download link.
     *
     * @param Sermon
     *
     * @return \Illuminate\Http\RedirectResponse
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
