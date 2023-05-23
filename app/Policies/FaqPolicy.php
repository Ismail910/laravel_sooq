<?php

namespace App\Policies;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
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
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show faqs')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Faq $faq)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show faqs')) {
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
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('create faqs')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Faq $faq)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('update faqs')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Faq $faq)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('delete faqs')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Faq $faq)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('restore faqs')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Faq $faq)
    {
        if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('force delete faqs')) {
            return true;
        }

        return false;
    }
}
