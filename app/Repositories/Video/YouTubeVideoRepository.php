<?php

namespace CompassHB\Www\Repositories\Video;

use GuzzleHttp\Client;
use Log;
use Cache;

use CompassHB\Www\Contracts\Video as Contract;

class YouTubeVideoRepository implements Contract
{
    private $url;
    private $client;
    private $domain = 'youtube.com';
    private $domain2 = 'youtu.be';

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Set the video url.
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get oembed iframe.
     *
     * @param bool $api
     * @return string
     * @internal param string $url location of video
     *
     */
    public function getEmbedCode($api = false)
    {
        $request = 'https://www.youtube.com/oembed?url='.$this->url;

        try {
            $response = $this->client->get($request);
        } catch (\Exception $e) {
            Log::warning('Connection refused to youtube.com');

            return;
        }

        $response_body = json_decode($response->getBody());

        return $response_body->html;
    }

    /**
     * Make an oembed request and return the thumbnail.
     *
     * @param bool $large
     * @return string
     * @internal param string $url
     */
    public function getThumbnail($large = false)
    {
        if ($this->url == '') {
            return;
        }

        if (Cache::has($this->url)) {
            return Cache::get($this->url);
        }

        $request = 'https://www.youtube.com/oembed?url='.$this->url;

        try {
            $response = $this->client->get($request);
        } catch (\Exception $e) {
            Log::warning('Connection refused to youtube.com');

            return;
        }

        $response_body = json_decode($response->getBody());

        Cache::add($this->url, $response_body->thumbnail_url, '1440');

        return $response_body->thumbnail_url;
    }

    public function getDownloadLink()
    {
        return $this->url;
    }

    public function getTextTracks($parse = false, $language = 'en')
    {
        return;
    }

    public function getLanguages()
    {
        return [];
    }

    public function getVideoPlays()
    {
        return;
    }
}
