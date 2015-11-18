<?php
# config/bugsnag.php

return array(
    'api_key' => env('BUGSNAG_API_KEY'),
    'notify_release_stages' => ['production', 'staging'],
);
