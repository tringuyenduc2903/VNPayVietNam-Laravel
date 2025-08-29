<?php

use BeetechAsia\VNPay\Enums\OrderType;
use BeetechAsia\VNPay\Facades\VNPay;
use Illuminate\Http\Client\ConnectionException;
use Random\RandomException;

it(
    'createPaymentUrl must be string',
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

        expect($response)->toBeString();
    }
);

it(
    'getBankCodes must be array',
    /**
     * @throws ConnectionException
     */
    function () {
        $bank_codes = VNPay::getBankCodes();

        expect($bank_codes)->dump()->toBeArray();
    }
);

it(
    'handleIpn Giao dịch thành công',
    function () {
        $data = [
            'vnp_Amount' => '84303500',
            'vnp_BankCode' => 'NCB',
            'vnp_CardType' => 'ATM',
            'vnp_OrderInfo' => 'A sunt aspernatur aliquam in dolore rerum enim.',
            'vnp_PayDate' => '20250828154830',
            'vnp_ResponseCode' => '00',
            'vnp_TmnCode' => 'XICEGCGJ',
            'vnp_TransactionNo' => '15153038',
            'vnp_TransactionStatus' => '00',
            'vnp_TxnRef' => '9d8849ec-ed01-3324-83d1-85b61484412f',
        ];

        $handle = VNPay::handleIpn(
            '9d8849ec-ed01-3324-83d1-85b61484412f',
            843035,
            fn (): bool => false,
            function () {},
            $data,
            secure_hash: 'a418549e0797a81214bdb4b318e09108c9ddb6d512f97bce315b0c6420261fbc91421481e6302783f1c62f3cb2b20fd0ab4d2b9685ddd49b35f5da76c79304d1',
            response_code: $data['vnp_ResponseCode'],
            transaction_status: $data['vnp_TransactionStatus'],
            txn_ref: $data['vnp_TxnRef'],
            amount: $data['vnp_Amount']
        );

        expect($handle)->dump()->toBe([
            'Message' => 'Confirm Success',
            'RspCode' => '00',
        ]);
    }
);

it(
    'handleIpn Giao dịch không thành công',
    function () {
        $data = [
            'vnp_Amount' => '5705000',
            'vnp_BankCode' => 'NCB',
            'vnp_CardType' => 'ATM',
            'vnp_OrderInfo' => 'Exercitationem beatae aut suscipit iste.',
            'vnp_PayDate' => '20250828154753',
            'vnp_ResponseCode' => '99',
            'vnp_TmnCode' => 'XICEGCGJ',
            'vnp_TransactionNo' => '15153034',
            'vnp_TransactionStatus' => '99',
            'vnp_TxnRef' => 'd861441f-c4d6-38fb-9290-3c6ca7fd2a23',
        ];

        $handle = VNPay::handleIpn(
            '9d8849ec-ed01-3324-83d1-85b61484412f',
            843035,
            fn (): bool => false,
            function () {},
            $data,
            secure_hash: '9f3060d2dd34dc72c6c2ff3d6512e67cd0598adac9e07b7fad70d9b980d6b7b958a8143f845e69b9969b2721e93f213a7de5de326752778dda7b05adc2fe02f7',
            response_code: $data['vnp_ResponseCode'],
            transaction_status: $data['vnp_TransactionStatus'],
            txn_ref: $data['vnp_TxnRef'],
            amount: $data['vnp_Amount']
        );

        expect($handle)->dump()->toBe([
            'Message' => 'Confirm Success',
            'RspCode' => '00',
        ]);
    }
);

it(
    'handleIpn Không tìm thấy giao dịch được confirm',
    function () {
        $data = [
            'vnp_Amount' => '84303500',
            'vnp_BankCode' => 'NCB',
            'vnp_CardType' => 'ATM',
            'vnp_OrderInfo' => 'A sunt aspernatur aliquam in dolore rerum enim.',
            'vnp_PayDate' => '20250828154830',
            'vnp_ResponseCode' => '00',
            'vnp_TmnCode' => 'XICEGCGJ',
            'vnp_TransactionNo' => '15153038',
            'vnp_TransactionStatus' => '00',
            'vnp_TxnRef' => '229d8849ec-ed01-3324-83d1-85b61484412f88',
        ];

        $handle = VNPay::handleIpn(
            '9d8849ec-ed01-3324-83d1-85b61484412f',
            843035,
            fn (): bool => false,
            function () {},
            $data,
            secure_hash: 'ed284bddcdb36c9294282d798d6a225b32433016bc50479da0737aa6748f824280b8dbe51d1ad0f253a1517798cc5e27408da9d491a5ba49ae19812c6d101e08',
            response_code: $data['vnp_ResponseCode'],
            transaction_status: $data['vnp_TransactionStatus'],
            txn_ref: $data['vnp_TxnRef'],
            amount: $data['vnp_Amount']
        );

        expect($handle)->dump()->toBe([
            'Message' => 'Order Not Found',
            'RspCode' => '01',
        ]);
    }
);

it(
    'handleIpn Giao dịch đã được confirm',
    function () {
        $data = [
            'vnp_Amount' => '84303500',
            'vnp_BankCode' => 'NCB',
            'vnp_CardType' => 'ATM',
            'vnp_OrderInfo' => 'A sunt aspernatur aliquam in dolore rerum enim.',
            'vnp_PayDate' => '20250828154830',
            'vnp_ResponseCode' => '00',
            'vnp_TmnCode' => 'XICEGCGJ',
            'vnp_TransactionNo' => '15153038',
            'vnp_TransactionStatus' => '00',
            'vnp_TxnRef' => '9d8849ec-ed01-3324-83d1-85b61484412f',
        ];

        $handle = VNPay::handleIpn(
            '9d8849ec-ed01-3324-83d1-85b61484412f',
            843035,
            fn (): bool => true,
            function () {},
            $data,
            secure_hash: 'a418549e0797a81214bdb4b318e09108c9ddb6d512f97bce315b0c6420261fbc91421481e6302783f1c62f3cb2b20fd0ab4d2b9685ddd49b35f5da76c79304d1',
            response_code: $data['vnp_ResponseCode'],
            transaction_status: $data['vnp_TransactionStatus'],
            txn_ref: $data['vnp_TxnRef'],
            amount: $data['vnp_Amount']
        );

        expect($handle)->dump()->toBe([
            'Message' => 'Order already confirmed',
            'RspCode' => '02',
        ]);
    }
);

it(
    'handleIpn Số tiền không hợp lệ',
    function () {
        $data = [
            'vnp_Amount' => '84303600',
            'vnp_BankCode' => 'NCB',
            'vnp_CardType' => 'ATM',
            'vnp_OrderInfo' => 'A sunt aspernatur aliquam in dolore rerum enim.',
            'vnp_PayDate' => '20250828154830',
            'vnp_ResponseCode' => '00',
            'vnp_TmnCode' => 'XICEGCGJ',
            'vnp_TransactionNo' => '15153038',
            'vnp_TransactionStatus' => '00',
            'vnp_TxnRef' => '9d8849ec-ed01-3324-83d1-85b61484412f',
        ];

        $handle = VNPay::handleIpn(
            '9d8849ec-ed01-3324-83d1-85b61484412f',
            843035,
            fn (): bool => false,
            function () {},
            $data,
            secure_hash: '9a9fa3b4ddc7f66781bb66511e91b0a1783e21665b9bf0ccd6e4a0e1c951fa64c80c022c1f6fac6f87fc44d53b24ddc34af2859da9949486811364a880fa1462',
            response_code: $data['vnp_ResponseCode'],
            transaction_status: $data['vnp_TransactionStatus'],
            txn_ref: $data['vnp_TxnRef'],
            amount: $data['vnp_Amount']
        );

        expect($handle)->dump()->toBe([
            'Message' => 'Invalid amount',
            'RspCode' => '04',
        ]);
    }
);

it(
    'handleIpn Chữ ký không hợp lệ',
    function () {
        $data = [
            'vnp_Amount' => '84303600',
            'vnp_BankCode' => 'NCB',
            'vnp_CardType' => 'ATM',
            'vnp_OrderInfo' => 'A sunt aspernatur aliquam in dolore rerum enim.',
            'vnp_PayDate' => '20250828154830',
            'vnp_ResponseCode' => '00',
            'vnp_TmnCode' => 'XICEGCGJ',
            'vnp_TransactionNo' => '15153038',
            'vnp_TransactionStatus' => '00',
            'vnp_TxnRef' => '9d8849ec-ed01-3324-83d1-85b61484412f',
        ];

        $handle = VNPay::handleIpn(
            '9d8849ec-ed01-3324-83d1-85b61484412f',
            843035,
            fn (): bool => false,
            function () {},
            $data,
            secure_hash: '',
            response_code: $data['vnp_ResponseCode'],
            transaction_status: $data['vnp_TransactionStatus'],
            txn_ref: $data['vnp_TxnRef'],
            amount: $data['vnp_Amount']
        );

        expect($handle)->dump()->toBe([
            'Message' => 'Invalid Checksum',
            'RspCode' => '97',
        ]);
    }
);
