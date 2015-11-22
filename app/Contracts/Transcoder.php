<?php

namespace CompassHB\Www\Contracts;

interface Transcoder
{
    public function saveAudio($url, $slug);
}
