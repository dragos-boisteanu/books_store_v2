<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert([ 
            'name'=> 'shakespeare',
            'first_name' => 'william',
        ]); 

        DB::table('authors')->insert([ 
            'name'=> 'christie',
            'first_name' => 'sgatha',
        ]);
         
        DB::table('authors')->insert([ 
            'name'=> 'cartland',
            'first_name' => 'barbara',
        ]); 

        DB::table('authors')->insert([ 
            'name'=> 'steel',
            'first_name' => 'danielle',
        ]);

        DB::table('authors')->insert([ 
            'name'=> 'gluhovski',
            'first_name' => 'dmitri',
        ]);
         
        

    }
}
