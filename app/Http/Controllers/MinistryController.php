<?php

namespace CompassHB\Www\Http\Controllers;

use GuzzleHttp\Client;
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
        $client = new Client();
        $body = $client->get('http://api.compasshb.com/youth/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'filter[cat]' => 1
            ]
        ])->getBody();

        $sermons = json_decode($body);

        // Handle 404 if page does not exist in API
        if (empty($sermons))
        {
            abort(404);
        } else {
            $sermon = $sermons[0];
        }

        return view(
            'ministries.youth.index',
            compact('sermon')
        )->with('title', 'The United');
    }

    public function youthsermon($sermon)
    {
        $client = new Client();
        $body = $client->get('http://api.compasshb.com/youth/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'filter[name]' => $sermon
            ]
        ])->getBody();

        $sermons = json_decode($body);

        // Handle 404 if page does not exist in API
        if (empty($sermons))
        {
            abort(404);
        } else {
            $sermon = $sermons[0];
        }

        return view(
            'dashboard.sermons.shownew',
            compact('sermon')
        )->with('title', 'Youth');
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
    public function men()
    {
        $client = new Client();
        $body = $client->get('http://api.compasshb.com/men/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'filter[posts_per_page]' => 500
            ]
        ])->getBody();

        $sermons = json_decode($body);
     //   dd($sermons);

        return view(
            'ministries.men.index',
            compact('sermons')
        )->with('title', 'Men');
    }

    public function mensermon($sermon)
    {
        $client = new Client();
        $body = $client->get('http://api.compasshb.com/men/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'filter[name]' => $sermon
            ]
        ])->getBody();

        $sermons = json_decode($body);

        // Handle 404 if page does not exist in API
        if (empty($sermons))
        {
            abort(404);
        } else {
            $sermon = $sermons[0];
        }

      //  dd($sermon);

        return view(
            'dashboard.sermons.shownew',
            compact('sermon')
        )->with('title', 'Men');
    }

    /**
     * Controller for Women ministry page.
     *
     * @param Video $video
     * @return \Illuminate\View\View
     */
    public function women()
    {
        $client = new Client();
        $body = $client->get('http://api.compasshb.com/women/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'filter[posts_per_page]' => 500
            ]
        ])->getBody();

        $sermons = json_decode($body);

        return view(
            'ministries.women.index',
            compact('sermons')
        )->with('title', 'Women');
    }

    public function womenmessage($sermon)
    {
        $client = new Client();
        $body = $client->get('http://api.compasshb.com/women/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'filter[name]' => $sermon
            ]
        ])->getBody();

        $sermons = json_decode($body);

        // Handle 404 if page does not exist in API
        if (empty($sermons))
        {
            abort(404);
        } else {
            $sermon = $sermons[0];
        }

        //  dd($sermon);

        return view(
            'dashboard.sermons.shownew',
            compact('sermon')
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
