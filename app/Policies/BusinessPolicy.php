<?php

namespace App\Policies;

use App\Models\Business;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Business  $business)
    {
        return $user->id === $business->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Business $business)
    {
        return $user->id === $business->user_id;
    }


}
