<?php

namespace App\Policies;

use App\Models\ContactReply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactReplyPolicy
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
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show contact-replies')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactReply  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContactReply $contact)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show contact-replies')) {
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
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('create contact-replies')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactReply  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContactReply $contact)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('update contact-replies')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactReply  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContactReply $contact)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('delete contact-replies')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactReply  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContactReply $contact)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('restore contact-replies')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactReply  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContactReply $contact)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('force delete contact-replies')) {
            return true;
        }

        return false;
    }
}
