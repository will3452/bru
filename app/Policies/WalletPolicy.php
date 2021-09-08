<?php

namespace App\Policies;

use App\User;
use App\Wallet;
use Illuminate\Auth\Access\HandlesAuthorization;

class WalletPolicy
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
        return $user->can('view wallet list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Wallet $wallet)
    {
        return $user->can('view wallet details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create wallet');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Wallet $wallet)
    {
        return $user->can('update wallet');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Wallet $wallet)
    {
        return $user->can('delete wallet');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Wallet $wallet)
    {
        return $user->can('restore wallet');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Wallet $wallet)
    {
        return $user->can('force delete wallet');
    }
}
