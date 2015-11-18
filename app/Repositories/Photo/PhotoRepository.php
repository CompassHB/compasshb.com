<?php

namespace CompassHB\Www\Repositories\Photo;

interface PhotoRepository
{
    public function getRecentPhotos();
    public function getPhotos($number);
}
