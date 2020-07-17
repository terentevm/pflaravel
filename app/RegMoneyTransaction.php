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
        'document_id',
        'document_type',
        'type',
        'sum'
    ];

    public function wallet()
    {
        return $this->belongsTo('App\Wallet', 'wallet_id', 'id');
    }

    public function scopeStart($query, $date)
    {
        return $query->where('date', '>=', $date);
    }

}
