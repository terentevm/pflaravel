<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends ModelByUser
{
    public $timestamps = true;

    protected $table = 'doc_transfers';

    protected $primaryKey = 'id';

    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'user_id',
        'date',
        'wallet_id_from',
        'wallet_id_to',
        'sum_from',
        'sum_to',
        'comment'
    ];

    protected $hidden = ['user_id'];

    public function walletFrom()
    {
        return $this->belongsTo('App\Wallet', 'wallet_id_from', 'id');
    }

    public function walletTo()
    {
        return $this->belongsTo('App\Wallet', 'wallet_id_to', 'id');
    }

}
