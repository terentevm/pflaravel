<?php


namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;

class NameFilter extends FilterAbstract
{
    public function filter(Builder $builder, $value)
    {

        if ($value === null) {
            return $builder;
        }

        return $builder->where('name', 'ILIKE', '%' . $value . '%');
    }
}