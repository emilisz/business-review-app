<?php

namespace App\Policies;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RatingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Rating $rating)
    {
        return $user->id === $rating->user_id;
    }


}
