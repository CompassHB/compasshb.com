<?php

namespace CompassHB\Www\Contracts;

interface Photos
{
    public function getRecentPhotos();
    public function getPhotos($number);
}
