<?php

namespace CompassHB\Www\Repositories\Analytics;

interface AnalyticRepository
{
    public function getPageViews($path, $startDate, $endDate);
    public function getActiveUsers();
}
