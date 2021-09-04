<?php

use App\Permission;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedAudiobookPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'view audio book list',
            'view audio book details',
            'update audio book',
            'restore audio book',
            'delete audio book',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'audio books', 'name' => $permission]);
        }

    }

  
}
