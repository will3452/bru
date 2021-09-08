<?php

use App\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedWalletCharacterMessagePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'view wallet list',
            'view wallet details',
            'update wallet',
            'create wallet',
            'delete wallet',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'wallets', 'name' => $permission]);
        }

        $permissions = [
            'view character list',
            'view character details',
            'update character',
            'create character',
            'delete character',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'characters', 'name' => $permission]);
        }

        $permissions = [
            'view message list',
            'view message details',
            'update message',
            'create message',
            'delete message',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['group' => 'messages', 'name' => $permission]);
        }

    }

}
