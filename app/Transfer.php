<?php

namespace App;

use App\Filters\TransferFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new TransferFilters($request))->add($filters)->filter($builder);
    }

    public function walletFrom()
    {
        return $this->belongsTo('App\Wallet', 'wallet_id_from', 'id');
    }

    public function walletTo()
    {
        return $this->belongsTo('App\Wallet', 'wallet_id_to', 'id');
    }

    public function transactionReg()
    {
        return $this->hasMany('App\RegMoneyTransaction', 'document_id', 'id');
    }

}
