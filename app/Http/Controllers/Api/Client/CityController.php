<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($countyId)
    {
        $cities = City::select('id', 'name')->where('county_id', $countyId)->get();
        
        return $cities;
    }
}
