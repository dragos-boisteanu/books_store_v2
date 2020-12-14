<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\County;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counties = County::all();
        $cities = array();

        foreach($counties as $county) {
            // get cities from json file

            $json = File::get('database/data/judete-orase.json');
            $data = json_decode($json,true);
         
            foreach($data["judete"] as $judet) {
                foreach($judet->localitati as $city) {
                    if($county->name = $judet["nume"]) {
                        City::create(array(
                            'name'=> $city->nume,
                            'county_id' => $county->id
                        ));
                    }
                }
            }
        }
    }
}
