<?php

namespace BeetechAsia\VNPay\Api;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Validator;

trait Query
{
    /**
     * @throws ConnectionException
     */
    public function getPaymentResult(array $data): array
    {
        Validator::validate($data, [
            'vnp_RequestId' => ['required'],
            'vnp_Version' => ['nullable', 'string', 'min:1', 'max:8'],
            'vnp_Command' => ['nullable', 'string', 'min:1', 'max:16'],
            'vnp_TmnCode' => ['nullable', 'string', 'size:8'],
            'vnp_TxnRef' => ['required'],
            'vnp_OrderInfo' => ['required', 'string', 'min:1', 'max:255'],
            'vnp_TransactionNo' => ['nullable', 'string', 'min:1', 'max:15'],
            'vnp_TransactionDate' => ['required', 'string', 'size:14', 'date_format:YmdHis'],
            'vnp_CreateDate' => ['nullable', 'string', 'size:14', 'date_format:YmdHis'],
            'vnp_IpAddr' => ['required', 'string', 'min:7', 'max:45', 'ip'],
            'vnp_SecureHash' => ['nullable', 'string', 'min:32', 'max:256'],
        ]);

        if (! isset($data['vnp_Version'])) {
            $data['vnp_Version'] = '2.1.0';
        }

        if (! isset($data['vnp_Command'])) {
            $data['vnp_Command'] = 'querydr';
        }

        if (! isset($data['vnp_TmnCode'])) {
            $data['vnp_TmnCode'] = config('vnpayvietnam.tmn_code');
        }

        if (! isset($data['vnp_CreateDate'])) {
            $data['vnp_CreateDate'] = now('Asia/Ho_Chi_Minh')->format('YmdHis');
        }

        if (! isset($data['vnp_SecureHash'])) {
            ksort($data);

            $data['vnp_SecureHash'] = hash_hmac(
                'sha512',
                sprintf(
                    '%s|%s|%s|%s|%s|%s|%s|%s|%s',
                    $data['vnp_RequestId'],
                    $data['vnp_Version'],
                    $data['vnp_Command'],
                    $data['vnp_TmnCode'],
                    $data['vnp_TxnRef'],
                    $data['vnp_TransactionDate'],
                    $data['vnp_CreateDate'],
                    $data['vnp_IpAddr'],
                    $data['vnp_OrderInfo']
                ),
                config('vnpayvietnam.hash_secret')
            );
        }

        return $this->getRequest()->post('merchant_webapi/api/transaction', $data)->json();
    }
}
