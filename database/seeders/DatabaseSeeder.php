<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GeneralSeeder::class);

       // \App\Models\User::factory(100)->create();

        //\App\Models\Client::factory(100)->create();
    }//run



}//class
