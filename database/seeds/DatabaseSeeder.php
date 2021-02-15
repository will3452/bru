<?php

use App\User;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\AuthorSeeder;
use Illuminate\Auth\Events\Verified;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call([AdminSeeder::class]);
        // $user = User::create([
        //     'first_name'=>'admin',
        //     'last_name'=>'admin',
        //     'email'=>'admin@admin.com',
        //     'password'=>\Hash::make('password'),
        //     'role'=>'administrator'
        // ]);
        
        // if ($user->markEmailAsVerified()) {
        //     event(new Verified($user));
        // }

    }
}
