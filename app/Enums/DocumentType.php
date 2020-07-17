<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Income()
 * @method static static Expense()
 * @method static static Transfer()
 * @method static static Debt()
 * @method static static ChangeBalance()
 */
final class TransactionType extends Enum
{
    const Income =   'income';
    const Expense =   'expense';
    const Transfer = 'transfer';
    const Debt = 'debt';
    const ChangeBalance = 'cb';
}
