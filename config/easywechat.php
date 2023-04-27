<?php
return [
    /*
     * 小程序
     */
    'mini' => [
        'default' => [
            'app_id'  => env('WECHAT_MINI_APP_APPID', ''),
            'secret'  => env('WECHAT_MINI_APP_SECRET', ''),
            'token'   => env('WECHAT_MINI_APP_TOKEN', ''),
            'aes_key' => env('WECHAT_MINI_APP_AES_KEY', ''),
            'http' => [
                'throw' => false,
            ],
        ],
    ],
];