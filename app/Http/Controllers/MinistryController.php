<?php

namespace CompassHB\Www\Http\Controllers;

use CompassHB\Www\Series;
use CompassHB\Www\Sermon;
use CompassHB\Www\Contracts\Video;

class MinistryController extends Controller
{
    /**
     * Controller for Kids Ministry page.
     *
     * @return \Illuminate\View\View
     */
    public function kids()
    {
        return view('ministries.kids.index')
            ->with('title', 'Kids Ministry');
    }

    /**
     * Controller for Youth Ministry page.
     *
     * @return \Illuminate\View\View
     */
    public function youth(Video $videoClient)
    {
        $series = Series::where('ministry', '=', 'youth')->get()->reverse();
        $sermons = Sermon::where('ministry', '=', 'youth')->latest('published_at')->published()->get();
        $prevsermon = $sermons->first();

        if ($prevsermon) {
            $videoClient->setUrl($prevsermon->video);
            $prevsermon->othumbnail = $videoClient->getThumbnail();
        } else {
            $prevsermon = (object) [
                'title' => '{{ Sermon title here }}',
                'slug' => 'sermon-slug-here',
                'othumbnail' => 'https://dummyimage.com/600x400/000/fff.jpg',
                'series' => (object) [
                    'title' => '{{ Series title here }}',
                ],
            ];
        }

        return view('ministries.youth.index',
            compact('sermons', 'series', 'prevsermon'))
            ->with('title', 'The United');
    }

    /**
     * Controller for Sunday School ministry page.
     *
     * @return \Illuminate\View\View
     */
    public function sundayschool()
    {
        $series = Series::where('ministry', '=', 'sundayschool')->get()->reverse();
        $sermons = Sermon::where('ministry', '=', 'sundayschool')->where('series_id', '=', $series->first()->id)->latest('published_at')->published()->get();

        return view('ministries.sundayschool.index',
            compact('sermons', 'series'))
            ->with('title', 'Sunday School');
    }

    /**
     * Controller for College Ministry page.
     *
     * @return \Illuminate\View\View
     */
    public function college()
    {
        return view('ministries.college.index')
            ->with('title', 'The Underground');
    }
}
