<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\County;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index() 
    {
        $addresses = Address::where('user_id', Auth::id())->get();
    
        return view('client.addresses.index', ['addresses' =>$addresses]);
    }
    
    public function create()
    {

    }
    

    public function edit($id)
    {
        $address = Address::findOrFail($id);
        $counties = County::all();

        return view('client.addresses.edit', ['address'=>$address, 'counties'=>$counties]);

    }

    public function update()
    {
        
    }

    public function destroy() 
    {
        
    }
}
