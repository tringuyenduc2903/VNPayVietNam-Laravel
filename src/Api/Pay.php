<?php

namespace BeetechAsia\VNPay\Api;

use BeetechAsia\VNPay\Enums\OrderType;
use BeetechAsia\VNPay\Enums\PayResponseCode;
use BeetechAsia\VNPay\Enums\PayTransactionStatus;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use InvalidArgumentException;

trait Pay
{
    public function createPaymentUrl(array $data, string $algo = 'sha512'): RedirectResponse
    {
        if (! in_array($algo, ['sha256', 'sha512'])) {
            throw new InvalidArgumentException(trans('Only supports sha256 and sha512 algorithms'));
        }

        Validator::validate($data, [
            'vnp_Version' => ['nullable', 'string', 'min:1', 'max:8'],
            'vnp_Command' => ['nullable', 'string', 'min:1', 'max:16'],
            'vnp_TmnCode' => ['nullable', 'string', 'size:8'],
            'vnp_Amount' => ['required', 'integer'],
            'vnp_BankCode' => ['nullable', 'string', 'min:3', 'max:20'],
            'vnp_CreateDate' => ['nullable', 'string', 'size:14', 'date_format:YmdHis'],
            'vnp_CurrCode' => ['nullable', 'string', 'size:3', 'in:VND'],
            'vnp_IpAddr' => ['required', 'string', 'min:7', 'max:45', 'ip'],
            'vnp_Locale' => ['nullable', 'string', 'min:2', 'max:5', 'in:vn,en'],
            'vnp_OrderInfo' => ['required', 'string', 'min:1', 'max:255'],
            'vnp_OrderType' => ['required', 'integer', Rule::in(OrderType::getValues())],
            'vnp_ReturnUrl' => ['required', 'string', 'min:10', 'max:255', 'url'],
            'vnp_ExpireDate' => ['required', 'string', 'size:14', 'date_format:YmdHis'],
            'vnp_TxnRef' => ['required'],
            'vnp_SecureHash' => ['nullable', 'string', 'min:32', 'max:256'],
        ]);

        if (! isset($data['vnp_Version'])) {
            $data['vnp_Version'] = '2.1.0';
        }

        if (! isset($data['vnp_Command'])) {
            $data['vnp_Command'] = 'pay';
        }

        if (! isset($data['vnp_TmnCode'])) {
            $data['vnp_TmnCode'] = config('vnpayvietnam.tmn_code');
        }

        if (! isset($data['vnp_SecureHash'])) {
            $data['vnp_Amount'] *= 100;
        }

        if (! isset($data['vnp_CreateDate'])) {
            $data['vnp_CreateDate'] = now('Asia/Ho_Chi_Minh')->format('YmdHis');
        }

        if (! isset($data['vnp_CurrCode'])) {
            $data['vnp_CurrCode'] = 'VND';
        }

        if (! isset($data['vnp_Locale'])) {
            $data['vnp_Locale'] = 'vn';
        }

        if (! isset($data['vnp_SecureHash'])) {
            ksort($data);

            $data['vnp_SecureHash'] = hash_hmac(
                $algo,
                http_build_query($data),
                config('vnpayvietnam.hash_secret')
            );
        }

        return redirect(sprintf('%s/paymentv2/vpcpay.html?%s', $this->getUrl(), http_build_query($data)));
    }

    /**
     * @throws ConnectionException
     */
    public function getBankCodes(?string $tmn_code = null): array
    {
        if (is_null($tmn_code)) {
            $tmn_code = config('vnpayvietnam.tmn_code');
        }

        return $this
            ->getRequest()
            ->asForm()
            ->post('qrpayauth/api/merchant/get_bank_list', compact('tmn_code'))
            ->json();
    }

    public function handleIpn(
        int|string $order_id,
        int|float $order_amount,
        callable $check_updated_order_callback,
        callable $update_order_callback,
        ?array $data = null,
        ?string $hash_secret = null,
        ?string $secure_hash = null,
        ?string $response_code = null,
        ?string $transaction_status = null,
        ?string $txn_ref = null,
        int|float|null $amount = null,
    ): array|false {
        if (is_null($data)) {
            $data = request()->except('vnp_SecureHash');
        }

        if (is_null($hash_secret)) {
            $hash_secret = config('vnpayvietnam.hash_secret');
        }

        if (is_null($secure_hash)) {
            $secure_hash = request('vnp_SecureHash', '');
        }

        if (is_null($response_code)) {
            $response_code = request('vnp_ResponseCode');
        }

        if (is_null($transaction_status)) {
            $transaction_status = request('vnp_TransactionStatus');
        }

        if (is_null($txn_ref)) {
            $txn_ref = request('vnp_TxnRef');
        }

        if (is_null($amount)) {
            $amount = is_int($order_amount)
                ? request()->integer('vnp_Amount')
                : request()->float('vnp_Amount');
        }

        $compared_hmac = hash_hmac('sha512', http_build_query($data), $hash_secret);

        // Chữ ký không hợp lệ
        if (! hash_equals($compared_hmac, $secure_hash)) {
            return [
                'Message' => 'Invalid Checksum',
                'RspCode' => '97',
            ];
        }

        // Giao dịch không thành công
        if ($response_code === PayResponseCode::OTHER_ERROR) {
            return [
                'Message' => 'Confirm Success',
                'RspCode' => '00',
            ];
        }

        // Không tìm thấy giao dịch được confirm
        if ($order_id != $txn_ref) {
            return [
                'Message' => 'Order Not Found',
                'RspCode' => '01',
            ];
        }

        // Số tiền không hợp lệ
        if ($order_amount * 100 !== $amount) {
            return [
                'Message' => 'Invalid amount',
                'RspCode' => '04',
            ];
        }

        if ($response_code === PayResponseCode::SUCCESS || $transaction_status === PayTransactionStatus::SUCCESS) {
            // Giao dịch đã được confirm
            if ($check_updated_order_callback($order_id, $data)) {
                return [
                    'Message' => 'Order already confirmed',
                    'RspCode' => '02',
                ];
            }

            $update_order_callback($order_id, $data);

            // Giao dịch thành công
            return [
                'Message' => 'Confirm Success',
                'RspCode' => '00',
            ];
        }

        return false;
    }
}
