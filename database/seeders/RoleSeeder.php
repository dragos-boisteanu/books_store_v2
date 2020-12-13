<?php

namespace Database\Seeders;

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
            'name' => 'Guest' //1
        ]);

        DB::table('roles')->insert([
            'name' => 'Administrator' //2
        ]);

        DB::table('roles')->insert([
            'name' => 'Staff' //3
        ]);

        DB::table('roles')->insert([
            'name' => 'Client' //4
        ]);
    }
}