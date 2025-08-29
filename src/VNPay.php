<?php

namespace BeetechAsia\VNPay;

use BeetechAsia\VNPay\Api\Pay;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class VNPay
{
    use Pay;

    public function getRequest(): PendingRequest
    {
        return Http::baseUrl($this->getUrl());
    }

    public function getUrl(): string
    {
        return config('vnpayvietnam.url');
    }
}
