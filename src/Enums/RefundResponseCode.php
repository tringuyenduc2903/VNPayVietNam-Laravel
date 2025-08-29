<?php

declare(strict_types=1);

namespace BeetechAsia\VNPay\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static SUCCESS()
 * @method static static INVALID_CONNECTION_ID()
 * @method static static INVALID_DATA_FORMAT()
 * @method static static TRANSACTION_NOT_FOUND()
 * @method static static DUPLICATE_REFUND_REQUEST()
 * @method static static TRANSACTION_NOT_SUCCESSFUL()
 * @method static static INVALID_CHECKSUM()
 * @method static static OTHER_ERROR()
 */
final class RefundResponseCode extends Enum implements LocalizedEnum
{
    const string SUCCESS = '00';

    const string INVALID_CONNECTION_ID = '02';

    const string INVALID_DATA_FORMAT = '03';

    const string TRANSACTION_NOT_FOUND = '91';

    const string DUPLICATE_REFUND_REQUEST = '94';

    const string TRANSACTION_NOT_SUCCESSFUL = '95';

    const string INVALID_CHECKSUM = '97';

    const string OTHER_ERROR = '99';
}
