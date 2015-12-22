<?php

namespace CompassHB\Www\Contracts;

interface Video
{
    /**
     * Set the URL to the video page.
     *
     * @param string $url
     */
    public function setUrl($url);

    /**
     * The embed code in HTML.
     *
     * @param bool $api
     * @return string
     * @internal param string $url
     *
     */
    public function getEmbedCode($api = false);

    /**
     * Get the WebVTT (.vtt) caption file
     * attached to a video.
     *
     * @param bool $parse
     * @param string $language
     * @return string
     */
    public function getTextTracks($parse = false, $language = 'en');

    /**
     * Get the number and names
     * of languages translated.
     *
     * @return string
     */
    public function getLanguages();

    /**
     * The link to cover image.
     *
     * @param bool $large returns default thumbnail from the oembed call
     *                      Set this to true if there is another way to grab a high resolution thumbnail
     * @return string
     * @internal param string $url
     */
    public function getThumbnail($large = false);

    public function getDownloadLink();
    public function getVideoPlays();
}
