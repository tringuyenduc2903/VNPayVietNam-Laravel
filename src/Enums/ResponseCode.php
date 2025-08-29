<?php

declare(strict_types=1);

namespace BeetechAsia\VNPay\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static SUCCESS()
 * @method static static SUSPECTED_FRAUD()
 * @method static static NO_INTERNET_BANKING()
 * @method static static INVALID_AUTHENTICATION()
 * @method static static TIMEOUT()
 * @method static static ACCOUNT_LOCKED()
 * @method static static INVALID_OTP()
 * @method static static CANCELLED()
 * @method static static INSUFFICIENT_BALANCE()
 * @method static static EXCEEDED_DAILY_LIMIT()
 * @method static static BANK_MAINTENANCE()
 * @method static static EXCEEDED_PASSWORD_ATTEMPTS()
 * @method static static OTHER_ERROR()
 */
final class ResponseCode extends Enum implements LocalizedEnum
{
    const string SUCCESS = '00';

    const string SUSPECTED_FRAUD = '07';

    const string NO_INTERNET_BANKING = '09';

    const string INVALID_AUTHENTICATION = '10';

    const string TIMEOUT = '11';

    const string ACCOUNT_LOCKED = '12';

    const string INVALID_OTP = '13';

    const string CANCELLED = '24';

    const string INSUFFICIENT_BALANCE = '51';

    const string EXCEEDED_DAILY_LIMIT = '65';

    const string BANK_MAINTENANCE = '75';

    const string EXCEEDED_PASSWORD_ATTEMPTS = '79';

    const string OTHER_ERROR = '99';
}
