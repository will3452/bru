<?php

use App\Permission;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedArtPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         $permissions = [
            'view art scene list',
            'view art scene details',
            'update art scene',
            'restore art scene',
            'delete art scene',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'art scenes', 'name' => $permission]);
        }
    }

    
}
