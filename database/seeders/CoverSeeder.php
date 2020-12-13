<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('covers')->insert([ 
            'name'=> 'paperback'
        ]); 

        DB::table('covers')->insert([ 
            'name'=> 'hardcover'
        ]); 

        DB::table('covers')->insert([ 
            'name'=> 'spiral-bound'
        ]); 
    }
}
