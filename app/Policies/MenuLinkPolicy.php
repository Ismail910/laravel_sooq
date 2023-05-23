<?php

namespace App\Policies;

use App\Models\MenuLink;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuLinkPolicy
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
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show menu-links')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MenuLink  $menuLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, MenuLink $menuLink)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show menu-links')) {
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
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('create menu-links')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MenuLink  $menuLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, MenuLink $menuLink)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('update menu-links')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MenuLink  $menuLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MenuLink $menuLink)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('delete menu-links')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MenuLink  $menuLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MenuLink $menuLink)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('restore menu-links')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MenuLink  $menuLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MenuLink $menuLink)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('force delete menu-links')) {
            return true;
        }

        return false;
    }
}
