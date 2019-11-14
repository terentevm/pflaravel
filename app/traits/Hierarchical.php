<?php
/**
 * Created by PhpStorm.
 *
 * Date: 19.08.2019
 * Time: 17:50
 */

namespace App\traits;

use App\Filters\Hierarchical\HierarchicalFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Hierarchical
{
    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new HierarchicalFilters($request))->add($filters)->filter($builder);
    }

    public static function findByParent($parent_id = null, $with_nested = true)
    {
        $items = static::where('parent_id', $parent_id)->orderBy('name')->get();

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