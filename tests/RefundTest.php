<?php

use BeetechAsia\VNPay\Enums\RefundTransactionType;
use BeetechAsia\VNPay\Facades\VNPay;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Carbon;

it(
    'sendRefundRequest must be array',
    /**
     * @throws ConnectionException
     */
    function () {
        $result = VNPay::sendRefundRequest([
            'vnp_RequestId' => fake()->uuid(),
            'vnp_TransactionType' => RefundTransactionType::getRandomValue(),
            'vnp_TxnRef' => 'b663e2c8-ed95-34bb-b7e7-355c7121d3a8',
            'vnp_Amount' => 0,
            'vnp_OrderInfo' => fake()->sentence(),
            'vnp_TransactionDate' => Carbon::parse('2025/08/28 13:23:25')->format('YmdHis'),
            'vnp_CreateBy' => fake()->name(),
            'vnp_IpAddr' => fake()->ipv4(),
        ]);

        expect($result)->dump()->toBeArray();
    }
);
