<?php
/**
 * 苏宁开放平台配置文档
 */
return [

    'default' => 'app',

    'connections' => [
        'app' => [
            'app_key'       => env('SUNING_APP_KEY', 'APP KEY'),
            'app_secret'    => env('SUNING_APP_SECRET', 'APP SECRET'),
            'server_url'    => env('SUNING_SERVER_URL', 'https://open.suning.com/api/http/sopRequest'),
            'format'        => 'json',
            'check_req'     => true,
        ]
    ]
];