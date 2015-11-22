<?php

namespace CompassHB\Www\Contracts;

interface Scripture
{
    public function getScripture($passage);
    public function getAudioScripture($passage);
}
