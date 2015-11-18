<?php

namespace CompassHB\Www\Repositories\Analytics;

class FakeAnalyticRepository implements AnalyticRepository
{
    public function getPageViews($path, $startDate, $endDate)
    {
        return [
            'sessions' => 3,
            'avgSessionDuration' => 5000,
        ];
    }

    public function getActiveUsers()
    {
        return 134;
    }
}
