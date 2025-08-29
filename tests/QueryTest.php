<?php

use BeetechAsia\VNPay\Facades\VNPay;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Carbon;

it(
    'getPaymentResult must be array',
    /**
     * @throws ConnectionException
     */
    function () {
        $payment_result = VNPay::getPaymentResult([
            'vnp_RequestId' => fake()->uuid(),
            'vnp_TxnRef' => 'b663e2c8-ed95-34bb-b7e7-355c7121d3a8',
            'vnp_OrderInfo' => fake()->sentence(),
            'vnp_TransactionDate' => Carbon::parse('2025/08/28 13:23:25')->format('YmdHis'),
            'vnp_IpAddr' => fake()->ipv4(),
        ]);

        expect($payment_result)->dump()->toBeArray();
    }
);
