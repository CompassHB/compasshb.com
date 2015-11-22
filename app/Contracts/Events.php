<?php

namespace CompassHB\Www\Contracts;

interface Events
{
    public function events();
    public function event($id);
    public function search($query);
}
