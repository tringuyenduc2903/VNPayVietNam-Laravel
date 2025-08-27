<?php

namespace BeetechAsia\VNPay\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BeetechAsia\VNPay\VNPay
 */
class VNPay extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \BeetechAsia\VNPay\VNPay::class;
    }
}
