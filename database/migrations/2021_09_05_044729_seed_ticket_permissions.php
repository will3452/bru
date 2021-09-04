<?php

use App\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedTicketPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'view ticket list',
            'view ticket details',
            'update ticket',
            'delete ticket',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'tickets', 'name' => $permission]);
        }
    }

}
