<?php

use App\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedPodcastPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'view podcast list',
            'view podcast details',
            'update podcast',
            'restore podcast',
            'delete podcast',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'podcasts', 'name' => $permission]);
        }

    }

}
