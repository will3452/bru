<?php

namespace App\Policies;

use App\Chapter;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChapterPolicy
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
        return $user->can('view chapter list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Chapter $chapter)
    {
        return $user->can('view chapter details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create chapter');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Chapter $chapter)
    {
        return $user->can('update chapter');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Chapter $chapter)
    {
        return $user->can('delete chapter');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Chapter $chapter)
    {
        return $user->can('restore chapter');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Chapter $chapter)
    {
        return $user->can('force delete chapter');
    }
}
