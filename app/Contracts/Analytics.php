<?php

namespace CompassHB\Www\Contracts;

interface Analytics
{
    public function getPageViews($path, $startDate, $endDate);
    public function getActiveUsers();
}
