<?php

namespace App;

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

    public function parent()
    {
        return $this->belongsTo('App\ItemExpenditure', 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany('App\ItemExpenditure', 'parent_id', 'id');
    }

    public static function findByParent($parent_id = null, $with_nested = true)
    {
        $items = static::where('parent_id', $parent_id)->get();

        foreach ($items as $item) {
            if ($with_nested === true) {
                $nested_items = self::findByParent($item->id, $with_nested);
            } else {
                $nested_items = [];
            }

            $item->items = $nested_items;
            $item->hasChild = count($nested_items) > 0;
        }

        return $items;
    }
}
