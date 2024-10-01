<?php

return [
    'default' => env('SLACK_WEBHOOK_URL_GENERAL'),

    'channels' => [
        'alerts' => env('SLACK_WEBHOOK_URL_ALERTS'),
    ],
];