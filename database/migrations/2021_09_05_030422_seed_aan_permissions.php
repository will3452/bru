<?php

use App\Permission;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedAanPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'view AAN list',
            'view AAN details',
            'create AAN',
            'delete AAN',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'AANs', 'name' => $permission]);
        }
    }

}
