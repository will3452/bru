<?php

namespace App\Policies;

use App\Audio;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AudioPolicy
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
        return $user->can('view audio book list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Audio  $audio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Audio $audio)
    {
        return $user->can('view audio book details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create audio book');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Audio  $audio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Audio $audio)
    {
        return $user->can('update audio book');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Audio  $audio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Audio $audio)
    {
        return $user->can('delete audio book');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Audio  $audio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Audio $audio)
    {
        return $user->can('restore audio book');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Audio  $audio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Audio $audio)
    {
        return $user->can('force delete audio book');
    }
}
