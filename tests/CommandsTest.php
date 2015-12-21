<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use CompassHB\Www\Console\Commands\BroadcastRefresh;


class CommandsTest extends TestCase
{

    public function test_boxcast_reminder()
    {
        $this->call('boxcast:reminder', '');
    }

    public function test_broadcast_refresh()
    {
        $this->call('broadcast:refresh', '');
    }

    public function test_featuredevent_reminder()
    {
        $this->call('featuredevent:reminder', '');
    }

    public function test_worksheet_reminder()
    {
        $this->call('worksheet:reminder', '');
    }

    public function test_passage_reminder()
    {
        $this->call('passage:reminder', '');
    }

    public function test_push_passage()
    {
        $this->call('push:passage', '');
    }

    public function test_forestall()
    {
        $this->call('Substrike\Forestall\DatabaseBackup@now', '');
    }


    public function test_the_broadcast_refresh_command_handles_empty_responses()
    {
        // Create a mock subscriber and queue two responses.
        // One with a JSON array and one with the error message
        $mock = new MockHandler([
            new Response(200, [], '[]'),
            new Response(200, [], '{}'),
        ]);

        $handler = \GuzzleHttp\HandlerStack::create($mock);

        $client = new Client(['handler' => $handler]);

        $broadcast = new BroadcastRefresh($client);

        // The following request will receive a 200 response from the plugin
        $broadcast->handle();

        // The following request will receive a 404 response from the plugin
        $broadcast->handle();
    }

}
