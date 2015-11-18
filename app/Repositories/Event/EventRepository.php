<?php

namespace CompassHB\Www\Repositories\Event;

interface EventRepository
{
    public function events();
    public function event($id);
    public function search($query);
}
