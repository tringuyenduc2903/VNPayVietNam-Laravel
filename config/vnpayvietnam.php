<?php

return [
    'url' => env('VNPAY_API_URL', 'https://sandbox.vnpayment.vn'),
    'tmn_code' => env('VNPAY_TMN_CODE', ''),
    'hash_secret' => env('VNPAY_HASH_SECRET', ''),
];
