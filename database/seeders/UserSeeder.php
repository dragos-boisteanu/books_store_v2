<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'guest',
            'name' => 'guest',
            'phone_number' => '000000000',
            'email' => 'guest@books.com',
            'role_id' => '1',
            'password' => Hash::make('12345678')
        ]);
        
        DB::table('users')->insert([
            'first_name' => 'adm',
            'name' => 'adm',
            'phone_number' => '000000000',
            'email' => 'adm@books.com',
            'role_id' => '2',
            'password' => Hash::make('12345678')
        ]);

       

        DB::table('users')->insert([
            'first_name' => 'client',
            'name' => 'client',
            'phone_number' => '000000000',
            'email' => 'client@books.com',
            'role_id' => '4',
            'password' => Hash::make('12345678')
        ]);

      
        
    }
}
