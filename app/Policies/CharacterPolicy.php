<?php

namespace App\Policies;

use App\Character;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CharacterPolicy
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
        return $user->can('view character list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Character  $character
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Character $character)
    {
        return $user->can('view character details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create character');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Character  $character
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Character $character)
    {
        return $user->can('update character');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Character  $character
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Character $character)
    {
        return $user->can('delete character');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Character  $character
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Character $character)
    {
        return $user->can('restore character');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Character  $character
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Character $character)
    {
        return $user->can('force delete character');
    }
}
