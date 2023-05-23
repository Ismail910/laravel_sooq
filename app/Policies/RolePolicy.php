<?php

namespace App\Policies;

use App\Models\Representative;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class RolePolicy
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
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show roles')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Role $model)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show roles')) {
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
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('create roles')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Role $model)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('update roles')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Role $model)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('delete roles')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Representative $model)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('restore roles')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Representative $model)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('force delete roles')) {
            return true;
        }

        return false;
    }
}
