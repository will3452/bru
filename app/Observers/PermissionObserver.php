<?php

namespace App\Observers;

use App\Permission;
use App\Role;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     *
     * @param  \App\Permission  $permission
     * @return void
     */
    public function created(Permission $permission)
    {
        $role = Role::where('name', Role::SUPERADMIN)->first();

        $role->givePermissionTo($permission);
    }
}
