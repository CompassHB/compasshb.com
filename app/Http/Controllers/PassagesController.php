<?php

namespace CompassHB\Www\Http\Controllers;

use Auth;
use CompassHB\Www\Passage;
use CompassHB\Www\Contracts\Analytics;
use CompassHB\Www\Contracts\Scripture;
use CompassHB\Www\Http\Requests\PassageRequest;

class PassagesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    protected $analytics;
    protected $scripture;

    public function __construct(Analytics $analytics, Scripture $scripture)
    {
        $this->analytics = $analytics;
        $this->scripture = $scripture;
        $this->middleware('auth', ['only' => ['edit', 'update', 'create', 'store', 'destroy']]);
    }

    /**
     * Show index/today's passage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $passage = Passage::latest('published_at')->published()->first();

        return $this->show($passage, true);
    }

    /**
     * Show a single passage.
     *
     * @param Passage $passage
     *
     * @return \Illuminate\View\View
     */
    public function show(Passage $passage, $today = false)
    {
        // For sidebar display
        $passages = Passage::latest('published_at')->published()->take(5)->get();

        $analytics = $this->analytics->getPageViews(
            '/read',
            $passage->published_at->format('Y-m-d'),
            $passage->published_at->format('Y-m-d')
        );
        $analytics['activeUsers'] = $this->analytics->getActiveUsers();

        $passage->verses = $this->scripture->getScripture($passage->title);
        $passage->audio = $this->scripture->getAudioScripture($passage->title);

        if ($today || $passage->published_at->isToday()) {
            $postflash = '';
            $title = 'Scripture of the Day';
            if ((date('D') == 'Sun' || date('D') == 'Sat') &&
                !$passage->published_at->isToday()) {
                $postflash = '<div class="alert alert-info" role="alert">Scripture of the Day is posted Monday through Friday.</div>';
            }
        } else {
            $title = $passage->title;
            $postflash = '<div class="alert alert-info" role="alert"><strong>New Post!</strong> You are reading an old post. For today\'s, <a href="/read">click here.</a></div>';
        }

        return view('dashboard.passages.show', compact('passage', 'passages', 'postflash', 'analytics'))
            ->with('title', $title);
    }

    /**
     * Edit an existing passage.
     *
     * @param Passage $passage
     *
     * @return \Illuminate\View\View
     */
    public function edit(Passage $passage)
    {
        return view('admin.passages.edit', compact('passage'));
    }

    /**
     * Update a passage.
     *
     * @param Passage        $passage
     * @param PassageRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Passage $passage, PassageRequest $request)
    {
        $passage->update($request->all());

        return redirect()
            ->route('admin.read')
            ->with('message', 'Success! Your Scripture of the Day was saved.');
    }

    /**
     * Show the page to create a new passage.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.passages.create');
    }

    /**
     * Store a new passage.
     *
     * @param PassageRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PassageRequest $request)
    {
        $passage = new Passage($request->all());

        Auth::user()->passages()->save($passage);

        return redirect()
            ->route('admin.read')
            ->with('message', 'Success! Your Scripture of the Day was saved.');
    }
}
