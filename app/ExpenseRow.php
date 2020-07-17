<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseRow extends ModelByUser
{
    public $timestamps = false;

    protected $table = 'doc_expenses_rows';

    protected $fillable = [
        'id',
        'doc_id',
        'user_id',
        'item_id',
        'sum',
        'comment'
    ];

    protected $hidden = ['user_id'];

    public function item()
    {
        return $this->belongsTo('App\ItemExpenditure', 'item_id', 'id');
    }

    public function getSum($value)
    {
        return floatval($value);
    }
}
