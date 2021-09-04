<?php

namespace App;

use Spatie\Permission\Models\Role as SRole;

class Role extends SRole
{
    const SUPERADMIN = 'super admin';

    protected $appends = ['prepared_permissions'];

    public function getPreparedPermissionsAttribute()
    {
        return $this->permissions->pluck('name')->toArray();
    }
}
