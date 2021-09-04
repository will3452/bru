<?php

use App\Role;
use App\User;
use Illuminate\Database\Migrations\Migration;

class SeedSuperAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $role = Role::create(['name' => Role::SUPERADMIN]);

        $user = User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'role' => 'admin',
            'email' => 'superadmin@bru.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($role);
    }

}
