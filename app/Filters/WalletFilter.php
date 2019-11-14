<?php
/**
 * Created by PhpStorm.
 *
 * Date: 19.08.2019
 * Time: 16:35
 */

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class WalletFilter extends FilterAbstract
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

        return $builder->where('wallet_id', '=', $value);
    }

}