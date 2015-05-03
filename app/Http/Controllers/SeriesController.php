<?php namespace CompassHB\Www\Http\Controllers;

use Auth;
use SearchIndex;
use CompassHB\Www\Series;
use CompassHB\Www\Sermon;
use CompassHB\Www\Http\Requests\SeriesRequest;

class SeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit', 'update', 'create', 'store', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $series = Series::all();

        return view('dashboard.series.index', compact('series'))
            ->with('title', 'Sermon Series');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SeriesRequest $request)
    {
        $series = new Series($request->all());

        Auth::user()->series()->save($series);

        SearchIndex::upsertToIndex($series);

        return redirect()
            ->route('admin');
    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\View\View
     */
    public function show(Series $series)
    {
        $sermons = Sermon::where('series_id', '=', $series->id)->latest('published_at')->published()->get();

        return view('dashboard.series.show', compact('series', 'sermons'))
            ->with('title', $series->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return \Illuminate\View\View
     */
    public function edit(Series $series)
    {
        return view('admin.series.edit', compact('series'));
    }

    /**
     * Update the specified resource in storage.
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Series $series, SeriesRequest $request)
    {
        $series->update($request->all());

        SearchIndex::upsertToIndex($series);

        return redirect()
            ->route('admin')
            ->with('message', 'Success! Your series was updated.');
    }
}
