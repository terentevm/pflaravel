<?php

namespace App;

class IncomeRow extends ModelByUser
{
    public $timestamps = false;

    protected $table = 'doc_income_rows';

    protected $fillable = [
        'id',
        'doc_id',
        'user_id',
        'item_id',
        'sum',
        'comment'
    ];

    protected $hidden = ['user_id'];

    protected $casts = [
        'sum' => 'decimal:2',
    ];


    public function item()
    {
        return $this->belongsTo('App\ItemIncome', 'item_id', 'id');
    }

    public function getSum($value)
    {
        return floatval($value);
    }
}
