<?php

namespace App;

class ItemIncome extends ModelByUser
{
    public $timestamps = false;

    protected $table = 'ref_items_income';

    protected $primaryKey = 'id';

    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'parent_id',
        'active',
        'comment'
    ];

    public function parent()
    {
        return $this->belongsTo('App\ItemIncome', 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany('App\ItemIncome', 'parent_id', 'id');
    }
}
