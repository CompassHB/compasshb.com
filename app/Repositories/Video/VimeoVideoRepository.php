<?php

namespace CompassHB\Www\Repositories\Video;

use Log;
use Cache;

use CompassHB\Www\Contracts\Video as Contract;

class VimeoVideoRepository implements Contract
{
    private $url;
    private $vimeoClient;
    private $client;
    private $clientId;
    private $clientSecret;
    private $token;
    private $domain = 'vimeo.com';
    private $oembed_url = 'https://vimeo.com/api/oembed.json?autoplay=false&url=';

    public function __construct()
    {
        $this->clientId = env('VIMEO_CLIENT_ID');
        $this->clientSecret = env('VIMEO_CLIENT_SECRET');
        $this->token = env('VIMEO_TOKEN');

        $this->vimeoClient = new \Vimeo\Vimeo($this->clientId, $this->clientSecret, $this->token);
        $this->client = new \GuzzleHttp\Client();
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
     * @param string $url location of video
     *
     * @return string
     */
    public function getEmbedCode($api = false)
    {
        $request = $this->oembed_url.$this->url;

        try {
            $response = $this->client->get($request);
        } catch (\Exception $e) {
            Log::warning('Connection refused to vimeo.com');

            return;
        }

        $response_body = json_decode($response->getBody());
        $response = $response_body->html;

        // Add the API tag when Javascript needs to interact with the player
        // per https://developer.vimeo.com/player/js-api
        if ($api) {
            $response = preg_replace('/" width=/', '?api=1&player_id=vimeoplayer" id="vimeoplayer" width=', $response);
        }

        return $response;
    }

    /**
     * Returns number and locale code
     * for translations available.
     */
    public function getLanguages()
    {
        $language = [];
        // Parse Vimeo video ID
        $videoId = substr($this->url, strrpos($this->url, '/') + 1);

        try {
            $video = $this->vimeoClient->request("/videos/$videoId/texttracks");

            if ($video['status'] == 200) {
                $total = $video['body']['total'];

                foreach ($video['body']['data'] as $item) {
                    array_push($language, $item['language']);
                }
            }

            return $language;
        } catch (\Exception $e) {
            Log::warning('Connection refused to vimeo.com:'.$e);

            return [];
        }
    }
    /**
     * Returns the WebVTT subtitles
     * and transcriptions/translations.
     */
    public function getTextTracks($parse = false, $language = 'en')
    {
        // Parse Vimeo video ID
        $videoId = substr($this->url, strrpos($this->url, '/') + 1);

        try {
            $video = $this->vimeoClient->request("/videos/$videoId/texttracks");

            if ($video['status'] == 200) {
                $key = array_search($language, array_column($video['body']['data'], 'language'));
                $request = $video['body']['data'][$key]['link'];

                // Using CURL because Guzzle does not like the + sign in the querystring
                $ch = curl_init($request);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $response = curl_exec($ch);

                /* Check for 404 (file not found). */
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($httpCode == 404) {
                    Log::warning('Connection refused to  www.esvapi.org');

                    $response = 'Connection error: www.vimeo.com. Please try again.';
                }

                curl_close($ch);

                // Converts subtitles (VTT) to HTML
                if ($parse) {
                    $response = preg_replace('/WEBVTT\n\n([\d|\.|\:]+)\s--> [\d|\.|\:]+/', '<p class="paragraph"><data class="paragraph_time">$1</data><span class="paragraph_text" data-time="$1">', $response); // Opening paragraph no mark
                    $response = preg_replace('/WEBVTT\n\nNOTE Paragraph\n\n([\d|\.|\:]+)\s--> [\d|\.|\:]+/', '<p class="paragraph"><data class="paragraph_time">$1</data><span class="paragraph_text" data-time="$1">', $response); // Opening paragraph with mark
                    $response = preg_replace('/NOTE Paragraph\n\n([\d|\.|\:]+)\s--> [\d|\.|\:]+/', '</span></p><p class="paragraph"><data class="paragraph_time">$1</data><span class="paragraph_text" data-time="$1">', $response); // Other paragraphs
                    $response = preg_replace('/\n\n([\d|\.|\:]+)\s--> [\d|\.|\:]+/', '</span><span class="paragraph_text" data-time="$1">', $response); // Data timestamp
                    $response .= '</span></p>'; // Closing paragraph
                    $response = preg_replace('/.\d\d\d/', '', $response); // remove milliseconds
                };

                return $response;
            }

            return;
        } catch (\Exception $e) {
            Log::warning('Connection refused to vimeo.com');

            return;
        }
    }

    /**
     * Make an oembed request and return the thumbnail.
     *
     * @param string $url
     *
     * @return string
     */
    public function getThumbnail($large = false)
    {
        if ($this->url == '') {
            return;
        }

        if (Cache::has($this->url)) {
            return Cache::get($this->url);
        }

        if ($large) {
            return $this->getVideoThumb($this->url);
        }

        $request = 'https://vimeo.com/api/oembed.json?url='.$this->url;

        try {
            $response = $this->client->get($request);
        } catch (\Exception $e) {
            Log::warning('Connection refused to vimeo.com');

            return;
        }

        $response_body = json_decode($response->getBody());

        Cache::add($this->url, $response_body->thumbnail_url, '1440');

        return $response_body->thumbnail_url;
    }

    /**
     * Returns the largest thumbnail from a video from Vimeo
     * to display on the homepage banner.
     *
     * @param string $url
     *
     * @return string
     */
    private function getVideoThumb()
    {
        // Parse Vimeo video ID
        $videoId = substr($this->url, strrpos($this->url, '/') + 1);

        try {
            $video = $this->vimeoClient->request("/videos/$videoId");

            if ($video['status'] == '404' || $video['status'] == '400') {
                return;
            }
        } catch (\Exception $e) {
            return;
        }

        // Get the video thumbnail
        if (!isset($video['body']['error']) &&
            $video['body'] != null &&
            isset(end($video['body']['pictures']['sizes'])['link'])) {
            return end($video['body']['pictures']['sizes'])['link'];
        }

        return;
    }

    /**
     * Link to download Vimeo video.
     *
     * @param string $videoUrl
     *
     * @return string
     */
    public function getDownloadLink()
    {
        $link = '';

        $id = substr($this->url, strrpos($this->url, '/') + 1);

        $video = $this->vimeoClient->request("/videos/$id");

        if ($video['status'] == '200') {
            $link = $video['body'];
            $link = $link['files'];
            $link = $link[1];
            $link = $link['link'];
        }

        return $link;
    }

    /**
     * Returns the play count stats.
     *
     * @param string $url
     *
     * @return string
     */
    public function getVideoPlays()
    {
        // Parse Vimeo video ID
        $videoId = substr($this->url, strrpos($this->url, '/') + 1);

        if (Cache::has($this->url.'plays')) {
            return Cache::get($this->url.'plays');
        }

        try {
            $video = $this->vimeoClient->request("/videos/$videoId");

            if ($video['status'] == '404' || $video['status'] == '400') {
                return;
            }
        } catch (\Exception $e) {
            return;
        }

        // Get the video stats
        if (isset($video['body']['stats']['plays'])) {
            Cache::add($this->url.'plays', $video['body']['stats']['plays'], '60');

            return $video['body']['stats']['plays'];
        }

        return;
    }
}
