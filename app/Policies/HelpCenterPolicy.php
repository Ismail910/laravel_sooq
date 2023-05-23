<?php

namespace App\Policies;

use App\Models\HelpCenter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HelpCenterPolicy
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
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show help-center')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, HelpCenter $helpCenter)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show help-center')) {
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
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('create help-center')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, HelpCenter $helpCenter)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('update help-center')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, HelpCenter $helpCenter)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('delete help-center')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, HelpCenter $helpCenter)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('restore help-center')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, HelpCenter $helpCenter)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('force delete help-center')) {
            return true;
        }

        return false;
    }
}
