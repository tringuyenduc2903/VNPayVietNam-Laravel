<?php

use BeetechAsia\VNPay\Enums\OrderType;
use BeetechAsia\VNPay\Facades\VNPay;
use Illuminate\Http\RedirectResponse;
use Random\RandomException;

it(
    'createPaymentUrl must be redirect to vnpay',
    /**
     * @throws RandomException
     */
    function () {
        $response = VNPay::createPaymentUrl([
            'vnp_Amount' => random_int(1000, 1000000),
            'vnp_IpAddr' => fake()->ipv4(),
            'vnp_OrderInfo' => fake()->sentence(),
            'vnp_OrderType' => OrderType::getRandomValue(),
            'vnp_ReturnUrl' => fake()->url(),
            'vnp_ExpireDate' => now('Asia/Ho_Chi_Minh')->addMinutes(10)->format('YmdHis'),
            'vnp_TxnRef' => fake()->uuid(),
        ]);

        expect($response)->toBeInstanceOf(RedirectResponse::class);
    }
);
