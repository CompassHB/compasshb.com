<?php

namespace CompassHB\Www\Repositories\Plan;

use Cache;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use CompassHB\Www\Contracts\Plan as Contract;

/**
 * Service for Planning Center API.
 *
 * @todo : exception handling
 */
class PcoPlanRepository implements Contract
{
    private $url = 'https://services.planningcenteronline.com/';
    private $consumerKey;
    private $consumerSecret;
    private $token;
    private $tokenSecret;

    public function __construct()
    {
        $this->token = env('PLANNINGCENTER_TOKEN_KEY');
        $this->tokenSecret = env('PLANNINGCENTER_TOKEN_SECRET');
        $this->consumerKey = env('PLANNINGCENTER_CONSUMER_KEY');
        $this->consumerSecret = env('PLANNINGCENTER_CONSUMER_SECRET');
    }

    /**
     * Get last week setlist.
     *
     * @return array
     */
    public function getSetList()
    {
        $setlist = Cache::remember('getsetlist', '360', function () {

            $setlist = [];

            $planId = '';
            $planDate = '';

            $stack = HandlerStack::create();

            $middleware = new Oauth1([
                'consumer_key' => $this->consumerKey,
                'consumer_secret' => $this->consumerSecret,
                'token' => $this->token,
                'token_secret' => $this->tokenSecret,
            ]);
            $stack->push($middleware);

            $client = new Client([
                'base_uri' => $this->url,
                'handler' => $stack,
                'auth' => 'oauth',
            ]);

            if (strlen($this->consumerKey) < 1) {
                return $setlist;
            }

            // Get Service ID for Weekend Service
            $res = $client->get('organization.json');

            $res = json_decode($res->getBody());
            $service = $res->service_types[1]->id;

            // Get Plans for all services
            $res = $client->get('service_types/'.$service.' /plans.json?all=true');
            $res = json_decode($res->getBody());
            $plans = $res;

            // Get Plan ID for most recent service
            foreach (array_reverse($plans) as $plan) {
                $planDate = Carbon::parse($plan->dates);
                $now = Carbon::now();

                if ($planDate->lt($now)) {
                    $planId = $plan->id;
                    break;
                }
            }

            // Get specific items from last weekend service
            $res = $client->get('plans/'.$planId.'.json');
            $res = json_decode($res->getBody());
            $items = $res->items;

            foreach ($items as $item) {
                // Only interested in songs
                if ($item->type == 'PlanSong') {
                    $tmp = [];
                    $tmp['title'] = $item->song->title;
                    $tmp['author'] = $item->song->author;
                    $tmp['date'] = $planDate;

                    // Add remote link to song if exists
                    foreach ($item->attachments as $attachment) {
                        if (isset($attachment->link)) {
                            $tmp['link'] = $attachment->link;
                        }
                        if (isset($attachment->public_url)) {
                            $tmp['link'] = $attachment->public_url;
                        }
                    }

                    $setlist[] = $tmp;
                }
            }

            return $setlist;
        });

        return $setlist;
    }
}
