<?php

namespace CompassHB\Www\Console\Commands;

use Cache;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class BroadcastRefresh extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'broadcast:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update cache with current live broadcast if available';

    /**
     * @var
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;

        parent::__construct();
    }

    /**
     * Returns the current (or very next upcoming) broadcast.
     *
     * @return ?\stdClass
     */
    private function getNextBroadcast()
    {
        $broadcastsResponse = $this->client->get(
            'https://api.boxcast.com/channels/gnskfahu15wlwpvroe22/broadcasts?q=timeframe:current%20timeframe:future&l=1'
        );
        $broadcasts = json_decode($broadcastsResponse->getBody(), true);

        return $broadcasts[0] ?? null;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $broadcast = $this->getNextBroadcast();
        if (!$broadcast) {
            return;
        }

        // we only want to show it if it starts within an hour
        $startTime = new Carbon($broadcast->starts_at);
        if (Carbon::now()->addHour()->gte($startTime)) {
            Cache::put('broadcast', $broadcast, 30);
        } else {
            Cache::forget('broadcast');
        }
    }
}
