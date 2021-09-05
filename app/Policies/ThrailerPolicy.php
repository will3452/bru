<?php

namespace App\Policies;

use App\Thrailer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThrailerPolicy
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
        return $user->can('view video list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Thrailer  $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Thrailer $video)
    {
        return $user->can('view video details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create video');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Thrailer  $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Thrailer $video)
    {
        return $user->can('update video');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Thrailer  $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Thrailer $video)
    {
        return $user->can('delete video');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Thrailer  $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Thrailer $video)
    {
        return $user->can('restore video');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Thrailer  $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Thrailer $video)
    {
        return $user->can('force delete video');
    }
}
