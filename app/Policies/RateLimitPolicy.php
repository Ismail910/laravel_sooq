<?php

namespace App\Policies;

use App\Models\RateLimit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RateLimitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show traffics')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RateLimit  $rateLimit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RateLimit $rateLimit)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show traffics')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('create traffics')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RateLimit  $rateLimit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RateLimit $rateLimit)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('update traffics')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RateLimit  $rateLimit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RateLimit $rateLimit)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('delete traffics')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RateLimit  $rateLimit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RateLimit $rateLimit)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('restore traffics')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RateLimit  $rateLimit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RateLimit $rateLimit)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('force delete traffics')) {
            return true;
        }

        return false;
    }
}
