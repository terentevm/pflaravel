<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 17.09.2019
 * Time: 17:49
 */

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

class WalletFromFilter extends FilterAbstract
{

    /**
     * Apply filter.
     *
     * @param  Builder $builder
     * @param  mixed $value
     *
     * @return Builder
     */
    public function filter(Builder $builder, $value)
    {
        if ($value === null) {
            return $builder;
        }

        return $builder->where('wallet_id_from', '=', $value);
    }
}