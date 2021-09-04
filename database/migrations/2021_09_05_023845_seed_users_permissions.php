<?php

use App\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedUsersPermissions extends Migration
{
    public function up()
    {
        $permissions = [
            'view user list',
            'view user details',
            'create user',
            'update user',
            'delete user',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'users', 'name' => $permission]);
        }

    }
}
