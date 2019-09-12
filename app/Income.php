<?php

namespace App;

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

    public function getSum($value)
    {
        return floatval($value);
    }
}
