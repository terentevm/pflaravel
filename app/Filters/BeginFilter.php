<?php
/**
 * Created by PhpStorm.
 *
 * Date: 19.08.2019
 * Time: 15:21
 */

namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;

class BeginFilter extends FilterAbstract
{

    /**
     * Filter by course type.
     *
     * @return Illuminate\Database\Eloquent\Builder
     * @param  string $type
     */
    public function filter(Builder $builder, $value)
    {

        if ($value === null) {
            return $builder;
        }

        return $builder->where('date', '>=', $value);
    }
}