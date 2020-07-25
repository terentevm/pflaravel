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
        'comment',
        'description'
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

    public function setDescription(string $description) : void
    {
        $this->attributes['description'] = trim($description);
    }

    public function buildDescription(array $rows)
    {
        $wallet = \App\Wallet::find($this->wallet_id);

        $item_ids = [];

        foreach ($rows as $row) {
            array_push($item_ids, $row['item_id']);
        }

        $items = \App\ItemExpenditure::find($item_ids)->toArray();

        $names = array_unique (array_column($items, 'name'));

        $this->setDescription(
            sprintf(
                'Expense from wallet:[%s]: %s',
                trim($wallet->name),
                implode(',', $names)
            )
        );

    }
}
