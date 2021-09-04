<?php

use App\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedVideosPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'view video list',
            'view video details',
            'update video',
            'restore video',
            'delete video',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'videos', 'name' => $permission]);
        }

    }

}
