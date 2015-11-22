<?php

namespace CompassHB\Www\Repositories\Video;

use CompassHB\Www\Contracts\Video as Contract;
use CompassHB\Www\Repositories\Video\VimeoVideoRepository;
use CompassHB\Www\Repositories\Video\YouTubeVideoRepository;
use CompassHB\Www\Repositories\Video\FakeVideoRepository;

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
     * @param string $url location of video
     *
     * @return string
     */
    public function getEmbedCode($api = false)
    {
        return $this->service->getEmbedCode($api);
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
        return $this->service->getThumbnail($large);
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
        return $this->service->getVideoThumb();
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
