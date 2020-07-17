<?php

namespace App;



class Settings extends ModelByUser
{
    protected $table = 'settings';

    protected $primaryKey = 'user_id';

    protected $keyType = 'uuid';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'currency_id',
        'wallet_id',
        'report_currency',
        'periodicity'
    ];


    public function currency()
    {
        return $this->hasOne('App\Currency', 'id', 'currency_id');
    }

    public function wallet()
    {
        return $this->hasOne('App\Wallet', 'id', 'wallet_id');
    }

    public function reportcurrency()
    {
        return $this->hasOne('App\Currency', 'id', 'report_currency');
    }
}
