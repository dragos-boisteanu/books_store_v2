<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([ 
            'name'=> 'card',
            'description' => 'Card',
            'tax' => 0
        ]);
        
        DB::table('payment_methods')->insert([ 
            'name'=> 'cash',
            'description' => 'Ramburs',
            'tax' => 10
        ]); 
    }
}
