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
        $this->call([
            StatusSeeder::class,
            TypeSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            JobSeeder::class
        ]);
    }
}
