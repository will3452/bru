<?php

use App\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedEventsPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'view event list',
            'view event details',
            'update event',
            'create event',
            'restore event',
            'delete event',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'events', 'name' => $permission]);
        }
    }

}
