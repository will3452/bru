<?php

use App\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedSongPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'view song list',
            'view song details',
            'update song',
            'restore song',
            'delete song',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'songs', 'name' => $permission]);
        }

    }
}
