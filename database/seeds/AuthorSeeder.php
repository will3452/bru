<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name'=>'William',
            'last_name'=>'Galas',
            'role'=>'author',
            'email'=>'william@mail.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('password') // password
        ]);
    }
}
