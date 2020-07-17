<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


/**
 * @method static static Income()
 * @method static static Expense()
 */
final class TransactionType extends Enum
{
    const Income =   'income';
    const Expense =   'expense';
}
