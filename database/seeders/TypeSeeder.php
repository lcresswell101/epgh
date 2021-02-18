<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'name' => 'electrician'
        ]);

        DB::table('types')->insert([
            'name' => 'plumber'
        ]);

        DB::table('types')->insert([
            'name' => 'drainage Engineer'
        ]);

        DB::table('types')->insert([
            'name' => 'gas engineer'
        ]);

        DB::table('types')->insert([
            'name' => 'oil engineer'
        ]);
    }
}
