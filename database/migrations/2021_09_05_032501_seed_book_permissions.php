<?php

use App\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedBookPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'view book list',
            'view book details',
            'update book',
            'restore book',
            'delete book',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'books', 'name' => $permission]);
        }
    }

}
