<?php
/**
 * Created by PhpStorm.
 *
 * Date: 25.08.2019
 * Time: 18:22
 */

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Wallet;
use phpDocumentor\Reflection\Types\Mixed_;

class BalanceRepository
{
    /**
     * Add to wallet info about balance
     *
     * @param Wallet $wallet
     * @return Wallet
     */
    public function getWalletWithBalance(Wallet $wallet): Wallet
    {
        $sql = 'SELECT * from balance_by_wallet(?)';

        $balanceData = DB::select($sql, [$wallet->id]);

        $wallet->balance = count($balanceData) > 0 ? $balanceData[0]->balance : 0;

        return $wallet;
    }


    public function balance(string $date, mixed $walletFilter = null)
    {

        $user_id = Auth::user()->id;

        $queryReg = DB::table('reg_money_trans')
            ->select('wallet_id', DB::raw('SUM(sum)'))
            ->groupBy('wallet_id');

        $queryReg->where('user_id', $user_id)
            ->where('date', '<=', $date);

        if (is_array($walletFilter) && count($walletFilter) > 0) {
            $queryReg->whereIn('wallet_id', $walletFilter);
        } elseif (is_string($walletFilter) && !empty($walletFilter)) {
            $queryReg->where('wallet_id', '=', $walletFilter);
        }

        $result = DB::table('ref_wallets')
            ->select([
                'ref_wallets.id as wallet_id',
                'ref_wallets.name as wallet_name',
                'ref_currencies.id as currency_id',
                'ref_currencies.short_name as currency_char_code',
                'reg.sum as balance'
            ])
            ->where('ref_wallets.user_id', '=', $user_id)
            ->joinSub($queryReg, 'reg', function ($join) {
                $join->on('ref_wallets.id', '=', 'reg.wallet_id');
            })
            ->join('ref_currencies', 'ref_wallets.currency_id', '=', 'ref_currencies.id')
            ->get();

        return $result;

    }
}