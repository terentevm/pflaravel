<?php

namespace App;

use App\traits\Hierarchical;

class ItemExpenditure extends ModelByUser
{
    public $timestamps = false;

    protected $table = 'ref_items_expenditure';

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

    protected $attributes = [
        'comment' => ''
    ];

    use Hierarchical;

    public function parent()
    {
        return $this->belongsTo('App\ItemExpenditure', 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany('App\ItemExpenditure', 'parent_id', 'id');
    }

}
