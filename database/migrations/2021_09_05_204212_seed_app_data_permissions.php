<?php

use App\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedAppDataPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'view app data list',
            'view app data details',
            'update app data',
            'create app data',
            'delete app data',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'app data', 'name' => $permission]);
        }

    }

}
