<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'name'=> 'guest',
            'first_name' => 'guest',
            'county_id' => '1',
            'city_id' => '1',
            'address' => 'guest',
            'postal_code' => '00000',
            'user_id' => '1',
            'phone_number' => '0000'
        ]);
    }
}
