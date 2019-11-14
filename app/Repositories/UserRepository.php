<?php
/**
 * Created by PhpStorm.
 *
 * Date: 06.11.2019
 * Time: 17:19
 */

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public static function getTotalRowsByUser(User $user)
    {
        $result = DB::select('select * from get_user_total_rows(?)', [$user->id]);

        return empty($result)
            ? 0
            : $result[0]->get_user_total_rows;

    }
}