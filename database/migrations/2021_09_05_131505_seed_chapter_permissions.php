<?php

use App\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedChapterPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'view chapter list',
            'view chapter details',
            'update chapter',
            'create chapter',
            'delete chapter',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'chapters', 'name' => $permission]);
        }

    }
}
