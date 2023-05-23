<?php

namespace App\Policies;

use App\Models\Representative;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RepresentativePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any representatives.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show representatives')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the representative.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Representative  $representative
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Representative $representative)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show representatives')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create representatives.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('create representatives')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the representative.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Representative  $representative
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Representative $representative)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('update representatives')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the representative.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Representative  $representative
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Representative $representative)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('delete representatives')) {
            return true;
        }

        return false;
    }
}
