<?php

namespace Database\Seeders;

use App\Script;
use Illuminate\Database\Seeder;

class ScriptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Script::create([
            'title'=>'copyright_disclaimer',
            'message'=>'I certify that I own sole copyright of all the materials I have uploaded on this site and my account, and that I have obtained permission in writing to use them, in case I share copyright with another individual or entity. I hold BRUMULTIVERSE free of liabilities should any copyright infringement occurs.'
        ]);
    }
}
