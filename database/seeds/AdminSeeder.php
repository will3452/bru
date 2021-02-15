<?php

namespace Database\Seeders;

use App\Role;
use App\User;
use App\Character;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'first_name'=>'Khiara',
            'last_name'=>'pasion',
            'type'=>'super admin',
            'email'=>'admin@admin.bru',
            'password'=>Hash::make('admin')
        ]);

        DB::table('scripts')->insert([
            'name'=>'copyright_disclaimer',
            'message'=>'I certify that I own sole copyright of all the materials I have uploaded on this site and my account, and that I have obtained permission in writing to use them, in case I share copyright with another individual or entity. I hold BRUMULTIVERSE free of liabilities should any copyright infringement occurs.'
        ]);

        DB::table('genres')->insert([
            ['name'=>'Teen and Young Adult'],
            ['name'=>'New Adult'],
            ['name'=>'Romance'],
            ['name'=>'Detective and Mystery'],
            ['name'=>'Action'],
            ['name'=>'Historical'],
            ['name'=>'Thriller and Horror'],
            ['name'=>'LGBTQIA+'],
            ['name'=>'Poetry'],
        ]);
        DB::table('settings')->insert([
            'event_day_away'=>'60'
        ]);
        //test users
        DB::table('users')->insert([
            'first_name'=>'William',
            'last_name'=>'Galas',
            'role'=>'author',
            'email'=>'william@mail.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('password') // password,
        ]);

        User::find(1)->interests()->create([
            'type'=>'college',
            'name'=>'Integrated School',
            'description'=>'Integrated School'
        ]);
        Character::create([
            'name'=>'Khiara Laurea'
        ]);
        Character::create([
            'name'=>'ANTONINA'
        ]);
        Character::create([
            'name'=>'JULIO'
        ]);

        Role::create([
            'name'=>'dashboard',
            'desc'=>'View dashboard.'
        ]);
        Role::create([
            'name'=>'audio-book',
            'desc'=>'access to audio book management page.'
        ]);
        Role::create([
            'name'=>'art',
            'desc'=>'access to art management page.'
        ]);
        Role::create([
            'name'=>'aan',
            'desc'=>'access to aan management page.'
        ]);
        Role::create([
            'name'=>'book',
            'desc'=>'access to book management page.'
        ]);
        Role::create([
            'name'=>'trailer',
            'desc'=>'access to trailer management page.'
        ]);
        Role::create([
            'name'=>'event',
            'desc'=>'access to event management page.'
        ]);
        Role::create([
            'name'=>'bin',
            'desc'=>'access to bin management page.'
        ]);
        Role::create([
            'name'=>'genre',
            'desc'=>'access to genre management page.'
        ]);
        Role::create([
            'name'=>'character',
            'desc'=>'access to character management page.'
        ]);
        Role::create([
            'name'=>'message',
            'desc'=>'access to message page.'
        ]);

        Role::create([
            'name'=>'profile',
            'desc'=>'access to profile page.'
        ]);
        Role::create([
            'name'=>'admin',
            'desc'=>'access to administrator management page.'
        ]);
    }
}
