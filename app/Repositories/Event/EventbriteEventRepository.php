<?php

namespace CompassHB\Www\Repositories\Event;

use Log;
use Cache;
use GuzzleHttp\Client;
use CompassHB\Www\Contracts\Events as Contract;

class EventbriteEventRepository implements Contract
{
    private $minutes = 300;
    private $client;
    private $token;
    private $url = 'https://www.eventbriteapi.com/v3/';

    public function __construct()
    {
        $this->token = env('EVENTBRITE_OAUTH_TOKEN');
        $this->client = new Client([
            'base_uri' => $this->url,
        ]);
    }

    /**
     * List of events matching search term.
     *
     * @param string $query
     * @return mixed
     */
    public function search($query)
    {
        $res = Cache::remember('searchevent', $this->minutes, function () use ($query) {

            try {
                $res = $this->client->get('events/search/?q='.urlencode($query).'&token='.$this->token);

                return json_decode($res->getBody());
            } catch (\Exception $e) {
                Log::warning('Connection refused to eventbriteapi.com');

                $obj = (object) [];
                $obj->events = [];

                return $obj;
            }

        });

        return $res;
    }

    /**
     * List of multiple events.
     *
     * @todo  better pagination support
     */
    public function events()
    {
        $res = Cache::remember('events', $this->minutes, function () {

            try {
                // Get first four pages of results
                $page1 = $this->client->get(
                    'users/me/owned_events/?expand=organizer,venue&status=live%2Cstarted&order_by=start_asc&page=1&token='.
                    env('EVENTBRITE_OAUTH_TOKEN')
                );
                $page2 = $this->client->get(
                    'users/me/owned_events/?expand=organizer,venue&status=live%2Cstarted&order_by=start_asc&page=2&token='.
                    env('EVENTBRITE_OAUTH_TOKEN')
                );
//			Get 2 pages instead of 4 because attemping to get pages that don't exist return a 400 error that needs to be handled
//                $page3 = $this->client->get(
//                    'users/me/owned_events/?expand=organizer,venue&status=live%2Cstarted&order_by=start_asc&page=3&token='.
//                    env('EVENTBRITE_OAUTH_TOKEN')
//                );
//                $page4 = $this->client->get(
//                    'users/me/owned_events/?expand=organizer,venue&status=live%2Cstarted&order_by=start_asc&page=4&token='.
//                    env('EVENTBRITE_OAUTH_TOKEN')
//                );

                $page1 = json_decode($page1->getBody());
                $page2 = json_decode($page2->getBody());
//                $page3 = json_decode($page3->getBody());
//                $page4 = json_decode($page4->getBody());

                $results = array_merge($page1->events, $page2->events);

                return $results;
            } catch (\Exception $e) {
                Log::warning('Connection refused to eventbriteapi.com');

                $obj = [];

                return $obj;
            }

        });

        return $res;
    }

    /**
     * Single event details.
     *
     * @param string $id
     * @return mixed
     */
    public function event($id)
    {
        $res = Cache::remember($id, $this->minutes, function () use ($id) {
            $res = $this->client->get('events/'.$id.'/?expand=organizer,venue&token='.env('EVENTBRITE_OAUTH_TOKEN'));

            return json_decode($res->getBody());
        });

        return $res;
    }
}
