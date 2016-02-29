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
     * @param Video $videoClient
     * @return \Illuminate\View\View
     */
    public function youth(Video $videoClient)
    {
        $series = Series::where('ministryId', '=', 'youth')->get()->reverse();
        $sermons = Sermon::where('ministryId', '=', 'youth')->latest('published_at')->published()->get();
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

        return view(
            'ministries.youth.index',
            compact('sermons', 'series', 'prevsermon')
        )->with('title', 'The United');
    }

    /**
     * Controller for Sunday School ministry page.
     *
     * @return \Illuminate\View\View
     */
    public function sundayschool()
    {
        $series = Series::where('ministryId', '=', 'sundayschool')->get()->reverse();
        $sermons = Sermon::where('ministryId', '=', 'sundayschool')
            ->where('series_id', '=', $series->first()->id)
            ->latest('published_at')
            ->published()
            ->get();

        return view(
            'ministries.sundayschool.index',
            compact('sermons', 'series')
        )->with('title', 'Sunday School');
    }

    /**
     * Controller for men ministry page.
     *
     * @param Video $video
     * @return \Illuminate\View\View
     */
    public function men(Video $video)
    {
        $sermons = Sermon::where('ministryId', '=', 'men')->latest('published_at')->published()->get();

        foreach ($sermons as $sermon) {
            $video->setUrl($sermon->video);
            $sermon->image = $video->getThumbnail();
        }

        return view(
            'ministries.men.index',
            compact('sermons')
        )->with('title', 'Men');
    }

    /**
     * Controller for Women ministry page.
     *
     * @param Video $video
     * @return \Illuminate\View\View
     */
    public function women(Video $video)
    {
        $sermons = Sermon::where('ministryId', '=', 'women')->latest('published_at')->published()->get();

        foreach ($sermons as $sermon) {
            $video->setUrl($sermon->video);
            $sermon->image = $video->getThumbnail();
        }

        return view(
            'ministries.women.index',
            compact('sermons')
        )->with('title', 'Women');
    }

    /**
     * Controller for marriage ministry page.
     *
     * @param Video $video
     * @return \Illuminate\View\View
     */
    public function marriage(Video $video)
    {
        $sermons = Sermon::where('ministryId', '=', 'marriage')->latest('published_at')->published()->get();

        foreach ($sermons as $sermon) {
            $video->setUrl($sermon->video);
            $sermon->image = $video->getThumbnail();
        }

        return view(
            'ministries.marriage.index',
            compact('sermons')
        )->with('title', 'Marriage');
    }

    /**
     * Controller for parenting ministry page.
     *
     * @param Video $video
     * @return \Illuminate\View\View
     */
    public function parenting(Video $video)
    {
        $sermons = Sermon::where('ministryId', '=', 'parenting')->latest('published_at')->published()->get();

        foreach ($sermons as $sermon) {
            $video->setUrl($sermon->video);
            $sermon->image = $video->getThumbnail();
        }

        return view(
            'ministries.parenting.index',
            compact('sermons')
        )->with('title', 'Parenting');
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
