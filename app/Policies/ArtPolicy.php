<?php

namespace App\Policies;

use App\Art;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtPolicy
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
        return $user->can('view art scene list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Art  $art
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Art $art)
    {
        return $user->can('view art scene details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create art scene');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Art  $art
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Art $art)
    {
        return $user->can('update art scene');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Art  $art
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Art $art)
    {
        return $user->can('delete art scene');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Art  $art
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Art $art)
    {
        return $user->can('restore art scene');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Art  $art
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Art $art)
    {
        return $user->can('force delete art scene');
    }
}
