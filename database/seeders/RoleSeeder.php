<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
           'name' => 'admin'
        ]);

        DB::table('roles')->insert([
            'name' => 'user'
        ]);

        User::find(1)->roles()->attach([1]);
        User::find(2)->roles()->attach([2]);
    }
}
