<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Year()
 * @method static static Quarter()
 * @method static static Month()
 * @method static static Week()
 * @method static static Day()
 */
final class PeriodicityOptions extends Enum
{
    const Year =   'year';
    const Quarter = 'quarter';
    const Month =   'month';
    const Week = 'week';
    const Day = 'day';
}
