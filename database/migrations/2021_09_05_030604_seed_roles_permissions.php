<?php

use App\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedRolesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'view role list',
            'view role details',
            'create role',
            'update role',
            'delete role',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'roles', 'name' => $permission]);
        }

    }

}
