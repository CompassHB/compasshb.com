<?php

namespace CompassHB\Www\Repositories\Analytics;

use Log;
use CompassHB\Www\Contracts\Analytics as Contract;

class GoogleAnalyticRepository implements Contract
{
    private $email;
    private $service;
    private $client;
    private $url = 'https://www.googleapis.com/auth/analytics.readonly';

    public function __construct()
    {
        $this->email = getenv('GOOGLE_ANALYTICS_EMAIL');
        $this->client = new \Google_Client();
        $this->client->setApplicationName('Compass HB');

        if (file_exists(storage_path('keys/CompassHB-27e1adae11b5.p12'))) {
            $this->client->setAssertionCredentials(
                new \Google_Auth_AssertionCredentials(
                    $this->email,
                    array($this->url),
                    file_get_contents(storage_path('keys/CompassHB-27e1adae11b5.p12'))
            ));
        }

        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setAccessType('offline_access');

        $this->service = new \Google_Service_Analytics($this->client);
    }

    /**
     * @param string $path
     * @param string $startDate
     * @param string $endDate
     */
    public function getPageViews($path, $startDate, $endDate)
    {
        $optParams = array(
            'dimensions' => 'ga:source,ga:keyword',
            'sort' => '-ga:users,ga:source',
            'filters' => 'ga:pagePath=='.$path,
            'max-results' => '25',
        );

        try {
            $results = $this->service->data_ga->get(
                'ga:89284462',
                $startDate,
                $endDate,
                'ga:users,ga:avgSessionDuration',
                $optParams
            );
        } catch (\Exception $e) {
            Log::warning('Connection refused to www.googleapis.com');

            return ['sessions' => 0];
        }

        return array(
            'sessions' => $results->totalsForAllResults['ga:users'],
            'avgSessionDuration' => round($results->totalsForAllResults['ga:avgSessionDuration'] / 60, 2),
        );
    }

    public function getActiveUsers()
    {
        $optParams = array('dimensions' => 'rt:medium');

        try {
            $results = $this->service->data_realtime->get(
                'ga:89284462',
                'rt:activeUsers',
                $optParams);
        } catch (\Exception $e) {
            Log::warning('Connection refused to www.googleapis.com');

            return 0;
        }

        return $results->totalsForAllResults['rt:activeUsers'];
    }
}
