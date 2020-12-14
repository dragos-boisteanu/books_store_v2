<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_methods')->insert([ 
            'name'=> 'currier',
            'description' => 'Curier rapid',
            'price' => 25.00
        ]); 

        DB::table('shipping_methods')->insert([ 
            'name'=> 'post',
            'description' => 'Posta Romana',
            'price' => 15.00
        ]); 


    }
}
