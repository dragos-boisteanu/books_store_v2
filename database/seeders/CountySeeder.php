<?php

namespace Database\Seeders;

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
        $json = File::get('database/data/judete.json');
        $data = json_decode($json,true);
        foreach ($data as $item) {
            County::create(array(
                'name' => $item['nume'],
                'auto' => $item['auto']
            ));
        }
    }
}
