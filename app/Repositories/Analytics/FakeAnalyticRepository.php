<?php

namespace CompassHB\Www\Repositories\Analytics;

use CompassHB\Www\Contracts\Analytics as Contract;

class FakeAnalyticRepository implements Contract
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
