<?php

namespace CompassHB\Www\Repositories\Event;

use CompassHB\Www\Contracts\Events as Contract;

class GoogleEventRepository implements Contract
{
    private $client;
    private $email;
    private $url = 'https://www.googleapis.com/auth/calendar.readonly';
    private $calendarId;
    private $service;

    public function __construct()
    {
        $this->calendarId = env('GOOGLE_CALENDAR_ID');
        $this->email = getenv('GOOGLE_ANALYTICS_EMAIL');
        $this->client = new \Google_Client();
        $this->client->setApplicationName('Compass HB');

        if (file_exists(storage_path('keys/CompassHB-27e1adae11b5.p12'))) {
            $this->client->setAssertionCredentials(
                new \Google_Auth_AssertionCredentials(
                    $this->email,
                    array($this->url),
                    file_get_contents(storage_path('keys/CompassHB-27e1adae11b5.p12'))
                )
            );
        }

        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setAccessType('offline_access');

        $this->service = new \Google_Service_Calendar($this->client);
    }

    public function events()
    {
        if ($this->calendarId == '') {
            return [];
        }

        // Print the next 10 events on the user's calendar.
        $calendarId = $this->calendarId;
        $optParams = array(
          'maxResults' => 10,
          'orderBy' => 'startTime',
          'singleEvents' => true,
          'timeMin' => date('c'),
        );
        $results = $this->service->events->listEvents($calendarId, $optParams);

        return $results;
    }

    public function event($id)
    {
    }

    public function search($query)
    {
    }
}
