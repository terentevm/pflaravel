<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModelByUserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function createCheckRowLimit(User $user)
    {
        return true;
        $allow = true;

        //check if user has rows limit. If row count limit exceeded
        //then creating new records is prohibited for this user
        if (!$user->isAdmin()) {
            $userLimit = $user->getRowsLimit();
            $total = $user->getTotalRowsCount();

            $allow = $userLimit > $total;
        }

        return $allow;
    }
}
