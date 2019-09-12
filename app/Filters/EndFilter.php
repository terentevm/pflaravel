<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 19.08.2019
 * Time: 15:21
 */

namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;

class EndFilter extends FilterAbstract
{

    /**
     * Filter by course type.
     *
     * @param  string $type
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function filter(Builder $builder, $value)
    {

        if ($value === null) {
            return $builder;
        }

        return $builder->where('date', '<=', $value);
    }
}