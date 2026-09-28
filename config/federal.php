<?php

return [
    'live_active' => env('FED_LIVE', false),
    'merchant_id' => 'WL0000000027698',
    'encryption_key' => '6375b97b954b37f956966977e5753ee6',
    'action_urls' => [
        'live' => 'https://ipg.in.worldline.com/doMEPayRequest',
        'test' => 'https://cgt.in.worldline.com/ipg/doMEPayRequest'
    ],
];