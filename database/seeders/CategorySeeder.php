<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([ 
            'name'=> 'culinare'
        ]); 

        DB::table('categories')->insert([ 
            'name'=> 'arta, arhitectura'
        ]); 

        DB::table('categories')->insert([ 
            'name'=> 'enciclopedii'
        ]); 

        DB::table('categories')->insert([ 
            'name'=> 'bibliografii, Memorii, Jurnale'
        ]); 

        DB::table('categories')->insert([ 
            'name'=> 'lingvistica, dictionare'
        ]); 

        DB::table('categories')->insert([ 
            'name'=> 'limbi straine'
        ]); 

        DB::table('categories')->insert([ 
            'name'=> 'poezie, teatru, studii literare'
        ]); 

        DB::table('categories')->insert([ 
            'name'=> 'fictiune'
        ]); 
    }
}
