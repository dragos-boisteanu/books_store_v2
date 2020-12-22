<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([ 
            'name'=> 'Nepreluata',
            'created_by' => 2,
            'updated_by' => 2
        ]); 

        DB::table('statuses')->insert([ 
            'name'=> 'Preluata',
            'created_by' => 2,
            'updated_by' => 2
        ]); 

        DB::table('statuses')->insert([ 
            'name'=> 'Pregatita',
            'created_by' => 2,
            'updated_by' => 2
        ]); 

        DB::table('statuses')->insert([ 
            'name'=> 'Trimisa',
            'created_by' => 2,
            'updated_by' => 2
        ]); 

        DB::table('statuses')->insert([ 
            'name'=> 'Efectuata',
            'created_by' => 2,
            'updated_by' => 2
        ]); 
    }
}
