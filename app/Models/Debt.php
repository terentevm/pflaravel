<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends ModelByUser
{
    public $timestamps = true;

    protected $table = 'doc_debts';

    protected $primaryKey = 'id';

    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'user_id',
        'date',
        'type',
        'debt_forgiveness',
        'wallet_id',
        'contact_id',
        'debit',
        'credit'
    ];

    protected $hidden = ['user_id'];

    public function wallet()
    {
        return $this->belongsTo('App\Wallet', 'wallet_id', 'id');
    }

    public function contact()
    {
        return $this->belongsTo('App\Contact', 'wallet_id', 'id');
    }
}
