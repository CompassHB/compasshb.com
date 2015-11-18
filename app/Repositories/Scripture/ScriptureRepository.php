<?php

namespace CompassHB\Www\Repositories\Scripture;

interface ScriptureRepository
{
    public function getScripture($passage);
    public function getAudioScripture($passage);
}
