<?php

namespace App;

use App\Filters\IncomeFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Income extends ModelByUser
{
    public $timestamps = true;

    protected $table = 'doc_income_header';

    protected $primaryKey = 'id';

    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'user_id',
        'date',
        'wallet_id',
        'sum',
        'comment'
    ];

    protected $hidden = ['user_id'];

    protected $casts = [
        'sum' => 'decimal:2',
    ];

    public function rows()
    {
        return $this->hasMany('App\IncomeRow', 'doc_id', 'id');
    }

    public function transactionReg()
    {
        return $this->hasOne('App\RegMoneyTransaction', 'document_id', 'id');
    }

    public function wallet()
    {
        return $this->belongsTo('App\Wallet', 'wallet_id', 'id');
    }

    public function getSum($value)
    {
        return floatval($value);
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new IncomeFilters($request))->add($filters)->filter($builder);
    }
}
