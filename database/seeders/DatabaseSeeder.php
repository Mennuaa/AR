<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [UserRolesSeeder::class, UserSeeder::class, StudioManagerSeeder::class, StudiouserSeeder::class];
      foreach($seeds as $seed){
        $this->call($seed);
      }

    }
}
