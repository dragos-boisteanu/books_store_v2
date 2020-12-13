<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publishers')->insert([ 
            'name'=> 'litera'
        ]); 

        DB::table('publishers')->insert([ 
            'name'=> 'paladin'
        ]); 

        DB::table('publishers')->insert([ 
            'name'=> 'penguin books ltd'
        ]); 


    }
}
