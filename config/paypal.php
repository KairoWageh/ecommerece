<?php 
return [ 

    'paypal_client_id' => env('PAYPAL_CLIENT_ID', ''),
    'paypal_secret_id' => env('PAYPAL_SECRET', ''),
    'settings' => array(
        'mode' => env('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
    'currency_code'    => env('PAYPAL_CURRENCY_CODE'),
];