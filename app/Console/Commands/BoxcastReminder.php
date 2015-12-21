<?php

namespace CompassHB\Www\Console\Commands;

use Mail;
use GuzzleHttp;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BoxcastReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boxcast:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new GuzzleHttp\Client();
        $broadcastsResponse = $client->get(
            'https://api.boxcast.com/channels/gnskfahu15wlwpvroe22/broadcasts?q=timeframe:future&l=1'
        );
        $broadcasts = json_decode($broadcastsResponse->getBody());

        if (isset($broadcasts[0])) {
            $broadcasts = $broadcasts[0];
            $startTime = new Carbon($broadcasts->starts_at);

            if (!$broadcasts || Carbon::now()->addWeek()->lte($startTime)) {
                Mail::send('emails.boxcast-reminder', [], function ($message) {
                    $message->subject('Schedule Boxcast Livestream');
                    $message->to('brad@compasshb.com');
                });
            }
        }

    }
}
