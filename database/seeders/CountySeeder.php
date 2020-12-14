<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\County;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/judete-orase.json');
        $data = json_decode($json,true);
     
        foreach($data["judete"] as $judet) {
            
            $county = new County();
            $county->name = $judet["nume"];
            $county->auto = $judet["auto"];

            $county->save();
            $county->refresh();
            
            foreach($judet["localitati"] as $localitate) {
                $city = new City();
                $city->name = $localitate["nume"];
                $city->county_id = $county->id;
                $city->save();
            }

        }

    }
}
