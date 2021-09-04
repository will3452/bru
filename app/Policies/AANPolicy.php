<?php

namespace App\Policies;

use App\AAN;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AANPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view AAN list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\AAN  $aAN
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AAN $aAN)
    {
        return $user->can('view AAN details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create AAN');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\AAN  $aAN
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AAN $aAN)
    {
        return $user->can('delete AAN');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\AAN  $aAN
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AAN $aAN)
    {
        return $user->can('restore AAN');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\AAN  $aAN
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AAN $aAN)
    {
        return $user->can('force delete AAN');
    }
}
