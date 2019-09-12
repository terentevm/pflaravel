<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegMoneyTransaction extends Model
{
    public $timestamps = false;

    protected $table = 'reg_money_trans';

    protected $fillable = [
        'user_id',
        'date',
        'wallet_id',
        'expend_id',
        'income_id',
        'transfer_id',
        'cb_id',
        'lend_id',
        'sum'
    ];

    public function wallet()
    {
        return $this->belongsTo('App\Wallet', 'wallet_id', 'id');
    }
}
