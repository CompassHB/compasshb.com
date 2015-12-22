<?php

namespace CompassHB\Www\Repositories\Video;

use CompassHB\Www\Contracts\Video as Contract;

class CompassVideoRepository implements Contract
{
    private $service;

    /**
     * Set the video url.
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        if (strpos($url, 'vimeo.com') !== false) {
            $this->service = new VimeoVideoRepository();
        } elseif (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
            $this->service = new YouTubeVideoRepository();
        } else {
            $this->service = new FakeVideoRepository();
        }

        $this->service->setUrl($url);
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
        return $this->service->getEmbedCode($api);
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
        return $this->service->getThumbnail($large);
    }

    /**
     * Returns the largest thumbnail from a video from Vimeo
     * to display on the homepage banner.
     * @return string
     * @internal param string $url
     *
     */
    private function getVideoThumb()
    {
        return $this->service->getVideoThumb();
    }

    /**
     * Link to download Vimeo video.
     * @return string
     * @internal param string $videoUrl
     *
     */
    public function getDownloadLink()
    {
        return $this->service->getDownloadLink();
    }

    public function getTextTracks($parse = false, $language = 'en')
    {
        return $this->service->getTextTracks($parse, $language);
    }

    public function getLanguages()
    {
        return $this->service->getLanguages();
    }

    public function getVideoPlays()
    {
        return $this->service->getVideoPlays();
    }
}
