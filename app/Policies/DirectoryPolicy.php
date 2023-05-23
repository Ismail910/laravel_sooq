<?php

namespace App\Policies;

use App\Models\Directory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DirectoryPolicy
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
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show directory')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Directory  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Directory $model)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show directory')) {
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
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('create directory')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Directory  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Directory $model)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('update directory')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Directory  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Directory $model)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('delete directory')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Directory  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Directory $model)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('restore directory')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Directory  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Directory $model)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('force delete directory')) {
            return true;
        }

        return false;
    }
}
