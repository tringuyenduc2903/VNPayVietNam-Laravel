<?php

declare(strict_types=1);

namespace BeetechAsia\VNPay\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static FULL()
 * @method static static PARTIAL()
 */
final class RefundTransactionType extends Enum implements LocalizedEnum
{
    const string FULL = '02';

    const string PARTIAL = '03';
}
