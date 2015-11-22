<?php

namespace CompassHB\Www\Repositories\Video;

use CompassHB\Www\Contracts\Video as Contract;

class FakeVideoRepository implements Contract
{
    public function setUrl($url)
    {
    }

    public function getEmbedCode($api = false)
    {
        return '<img src="https://dummyimage.com/600x400/000/fff.jpg"/>';
    }

    public function getThumbnail($large = false)
    {
        return '';
    }

    public function getDownloadLink()
    {
        return '';
    }

    public function getTextTracks($parse = false, $language = 'en')
    {
        return '';
    }

    public function getLanguages()
    {
        return [];
    }

    public function getVideoPlays()
    {
        return '';
    }
}
