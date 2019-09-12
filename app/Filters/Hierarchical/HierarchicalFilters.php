<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 19.08.2019
 * Time: 17:51
 */

namespace App\Filters\Hierarchical;


use App\Filters\FiltersAbstract;

class HierarchicalFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'parent' => ParentFilter::class,

    ];
}