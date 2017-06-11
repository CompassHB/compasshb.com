<?php

namespace CompassHB\Www\Http\Controllers;

use GuzzleHttp\Client;
use CompassHB\Www\Contracts\Video;

class MinistryController extends Controller
{
    /**
     * Controller for Kids Ministry page.
     *
     * @return \Illuminate\View\View
     */
//    public function kids()
//    {
//        return view('ministries.kids.index')
//            ->with('title', 'Kids Ministry');
//    }

    public function kids()
    {
        $client = new Client();

        $body = $client->get('https://api.compasshb.com/kids/wp-json/wp/v2/pages?slug=kids')->getBody();

        $content = json_decode($body);
        $content = $content[0]->content->rendered;

        return view('ministries.kids.index', compact('content'))
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
        $body = $client->get('https://api.compasshb.com/youth/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'categories' => 1
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
        $body = $client->get('https://api.compasshb.com/youth/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'slug' => $sermon
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
            'dashboard.sermons.show',
            compact('sermon')
        )->with('title', 'Youth');
    }

    /**
     * Controller for Bible Class ministry page.
     *
     * @return \Illuminate\View\View
     */
    public function sundayschool()
    {
        $client = new Client();
        $body = $client->get('https://api.compasshb.com/sunday-school/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'categories' => 1
            ]
        ])->getBody();

        $sermons = json_decode($body);

        $body = $client->get('https://api.compasshb.com/sunday-school/wp-json/wp/v2/tags?embed')->getBody();

        $series = array_reverse(json_decode($body));

        return view(
            'ministries.sundayschool.index',
            compact('sermons', 'series')
        )->with('title', 'Bible Class');
    }


    public function sundayschoolsermon($sermon)
    {
        $client = new Client();
        $body = $client->get('https://api.compasshb.com/sunday-school/wp-json/wp/v2/posts', [
            'query' => [
                '_embed' => true,
                'slug' => $sermon
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
            'dashboard.sermons.show',
            compact('sermon')
        )->with('title', 'Bible Class');
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
        $body = $client->get('https://api.compasshb.com/men/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'per_page' => 100
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
        $body = $client->get('https://api.compasshb.com/men/wp-json/wp/v2/posts?embed', [
            'query' => [
                '_embed' => true,
                'slug' => $sermon
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
            'dashboard.sermons.show',
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
        $body = $client->get('https://api.compasshb.com/women/wp-json/wp/v2/posts', [
            'query' => [
                '_embed' => true,
                'per_page' => 100
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
        $body = $client->get('https://api.compasshb.com/women/wp-json/wp/v2/posts', [
            'query' => [
                '_embed' => true,
                'slug' => $sermon
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
            'dashboard.sermons.show',
            compact('sermon')
        )->with('title', 'Women');
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
