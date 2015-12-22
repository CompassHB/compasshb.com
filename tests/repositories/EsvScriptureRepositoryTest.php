<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use CompassHB\Www\Repositories\Scripture\EsvScriptureRepository;


class EsvScriptureRepositoryTest extends TestCase
{

    public function test_getAudioScripture()
    {
        $passage = 'Psalm 1';

        // Create a mock subscriber and queue two responses.
        // One with a Location header and one without
        $mock = new MockHandler([
            new Response(200, ['X-Guzzle-Redirect-History' => 'http://www.example.com']),
            new Response(200)
        ]);

        $handler = \GuzzleHttp\HandlerStack::create($mock);

        $client = new Client(['handler' => $handler]);

        $scripture = new EsvScriptureRepository($client);

        // The following request will receive a Location header
        $scripture->getAudioScripture($passage);

        // The following request will receive no Location header
        $scripture->getAudioScripture($passage);
    }

}