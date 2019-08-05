<?php

namespace App;

class Wallet extends ModelByUser
{
    public $timestamps = false;

    protected $table = 'ref_wallets';

    protected $primaryKey = 'id';

    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'currency_id',
        'is_creditcard',
        'grace_period',
        'credit_limit'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_creditcard' => false,
        'grace_period' => 0,
        'credit_limit' => 0
    ];

    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
}
