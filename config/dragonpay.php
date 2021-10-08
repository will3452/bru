<?php
return [
    // testing for 0, live for 1
    'environment'=>env('DRAGONPAY_ENVIRONTMENT'),
    'merchant'=>[
        'id'=>env('DRAGONPAY_MERCHANT_ID', ''),
        'password'=>env('DRAGONPAY_MERCHANT_PASSWORD', '')
    ]
];
