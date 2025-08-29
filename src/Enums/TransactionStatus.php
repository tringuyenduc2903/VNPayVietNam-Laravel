<?php

declare(strict_types=1);

namespace BeetechAsia\VNPay\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static SUCCESS()
 * @method static static INCOMPLETE()
 * @method static static ERROR()
 * @method static static REVERSED()
 * @method static static PROCESSING_REFUND()
 * @method static static REFUND_REQUEST_SENT()
 * @method static static SUSPECTED_FRAUD()
 * @method static static REFUND_REJECTED()
 */
final class TransactionStatus extends Enum implements LocalizedEnum
{
    const string SUCCESS = '00';

    const string INCOMPLETE = '01';

    const string ERROR = '02';

    const string REVERSED = '04';

    const string PROCESSING_REFUND = '05';

    const string REFUND_REQUEST_SENT = '06';

    const string SUSPECTED_FRAUD = '07';

    const string REFUND_REJECTED = '09';
}
