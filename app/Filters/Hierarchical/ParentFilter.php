<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 19.08.2019
 * Time: 17:54
 */

namespace App\Filters\Hierarchical;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\FilterAbstract;

class ParentFilter extends FilterAbstract
{
    public function filter(Builder $builder, $value)
    {
        return $builder->where('parent_id', '=', $value);
    }
}