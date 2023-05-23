<?php

namespace App\Policies;

use App\Models\Redirection;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RedirectionPolicy
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
                if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show redirections')) {
                        return true;
                }

                return false;
        }

        /**
         * Determine whether the user can view the model.
         *
         * @param  \App\Models\User  $user
         * @param  \App\Models\Redirection  $redirection
         * @return \Illuminate\Auth\Access\Response|bool
         */
        public function view(User $user, Redirection $redirection)
        {
                if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('show redirections')) {
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
                if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('create redirections')) {
                        return true;
                }

                return false;
        }

        /**
         * Determine whether the user can update the model.
         *
         * @param  \App\Models\User  $user
         * @param  \App\Models\Redirection  $redirection
         * @return \Illuminate\Auth\Access\Response|bool
         */
        public function update(User $user, Redirection $redirection)
        {
                if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('update redirections')) {
                        return true;
                }

                return false;
        }

        /**
         * Determine whether the user can delete the model.
         *
         * @param  \App\Models\User  $user
         * @param  \App\Models\Redirection  $redirection
         * @return \Illuminate\Auth\Access\Response|bool
         */
        public function delete(User $user, Redirection $redirection)
        {
                if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('delete redirections')) {
                        return true;
                }

                return false;
        }

        /**
         * Determine whether the user can restore the model.
         *
         * @param  \App\Models\User  $user
         * @param  \App\Models\Redirection  $redirection
         * @return \Illuminate\Auth\Access\Response|bool
         */
        public function restore(User $user, Redirection $redirection)
        {
                if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('restore redirections')) {
                        return true;
                }

                return false;
        }

        /**
         * Determine whether the user can permanently delete the model.
         *
         * @param  \App\Models\User  $user
         * @param  \App\Models\Redirection  $redirection
         * @return \Illuminate\Auth\Access\Response|bool
         */
        public function forceDelete(User $user, Redirection $redirection)
        {
                if (in_array($user->power, ["ADMIN"]) && $user->hasPermissionTo('force delete redirections')) {
                        return true;
                }

                return false;
        }
}
