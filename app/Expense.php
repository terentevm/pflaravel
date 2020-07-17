<?php

namespace App;

use App\Filters\ExpensesFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Expense extends ModelByUser
{
    public $timestamps = true;

    protected $table = 'doc_expenses_header';

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

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new ExpensesFilters($request))->add($filters)->filter($builder);
    }

    public function rows()
    {
        return $this->hasMany('App\ExpenseRow', 'doc_id', 'id');
    }

    public function wallet()
    {
        return $this->belongsTo('App\Wallet', 'wallet_id', 'id');
    }

    public function getSum($value)
    {
        return floatval($value);
    }

    public function transactionReg()
    {
        return $this->hasOne('App\RegMoneyTransaction', 'document_id', 'id');
    }
}
