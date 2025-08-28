<?php

namespace BeetechAsia\VNPay;

use BeetechAsia\VNPay\Enums\OrderType;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use InvalidArgumentException;

class VNPay
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
            'vnp_TxnRef' => ['required', 'string', 'min:1', 'max:100'],
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

        return redirect(sprintf('%s?%s', $this->getUrl(), http_build_query($data)));
    }

    public function getUrl(): string
    {
        return config('vnpayvietnam.url');
    }

    public function getRequest(): PendingRequest
    {
        return Http::baseUrl($this->getUrl());
    }
}
