<?php
/*
 * 联盟配置文件
 */
return [
    'pinduoduo' => [ // 拼多多
        'client_id' => env('PDD_CLIENT_ID', ''),
        'client_secret' => env('PDD_CLIENT_SECRET', ''),
        'format' => 'json',
    ],
    'jingdong' => [ // 京东
        'app_key' => env('JD_APP_KEY', ''),
        'app_secret' => env('JD_APP_SECRET', ''),
        'format' => 'json',
    ],
];
