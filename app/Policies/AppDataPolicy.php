<?php

namespace App\Policies;

use App\AppData;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppDataPolicy
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
        return $user->can('view app data list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\AppData  $appData
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AppData $appData)
    {
        return $user->can('view app data details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create app data');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\AppData  $appData
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AppData $appData)
    {
        return $user->can('update app data');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\AppData  $appData
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AppData $appData)
    {
        return $user->can('delete app data');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\AppData  $appData
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AppData $appData)
    {
        return $user->can('restore app data');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\AppData  $appData
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AppData $appData)
    {
        return $user->can('force delete app data');
    }
}
