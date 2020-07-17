<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeBalance extends ModelByUser
{
    public $timestamps = true;

    protected $table = 'doc_change_balance';

    protected $primaryKey = 'id';

    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'user_id',
        'date',
        'wallet_id',
        'new_balance',
        'sum_expend',
        'sum_income'
    ];

    protected $hidden = ['user_id'];

    public function wallet()
    {
        return $this->belongsTo('App\Wallet', 'wallet_id', 'id');
    }

    public function transactionReg()
    {
        return $this->hasOne('App\RegMoneyTransaction', 'document_id', 'id');
    }
}
