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
            // Storage::append('cities.json', $response->body());

            // get cities from api
            // $response = Http::get('https://roloca.coldfuse.io/orase/'.$county->auto);
            // if($response->successful() && $response->status() === 200) {
               
            //     $cities = json_decode($response->body());  
            //     foreach($cities as $city) {
            //         City::create(array(
            //             'name'=> $city->nume,
            //             'county_id' => $county->id
            //         ));
            // }

            // get cities from json file
            $json = File::get('database/data/judete.json');
            $cities = json_decode($json);          
            foreach($cities as $city) {
                City::create(array(
                    'name'=> $city->nume,
                    'county_id' => $county->id
                ));
            }       
        }
    }
}
