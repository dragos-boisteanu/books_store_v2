<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\County;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $counties = County::all();

        return view('client.addresses.create', ['counties'=>$counties]);
    }
    
    public function store(Request $request) 
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        
        $input['default_for_invoice'] = isset($request->default_for_invoice) ? true : false;
        $input['default_for_shipping'] = isset($request->default_for_shipping) ? true : false;
        

        if($request->has('default_for_invoice')) {
            DB::update('update addresses set default_for_invoice = 0 where user_id = :id', ['id' => Auth::id() ]);
        }

        if($request->has('default_for_shipping')) {
            DB::update('update addresses set default_for_shipping = 0 where user_id = :id', ['id' => Auth::id() ]);
        }

        
        Address::create($input);

        return redirect()->route('client-addresses.index');
    }

    public function edit($id)
    {
        $address = Address::findOrFail($id);
        $counties = County::all();
        
        return view('client.addresses.edit', ['address'=>$address, 'counties'=>$counties]);
    }

    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        $input = $request->all();

        $input['default_for_invoice'] = isset($request->default_for_invoice) ? true : false;
        $input['default_for_shipping'] = isset($request->default_for_shipping) ? true : false;

   
        if($request->has('default_for_invoice')) {
            DB::update('update addresses set default_for_invoice = 0 where user_id = :id', ['id' => Auth::id() ]);
        }

       
        if($request->has('default_for_shipping')) {
            DB::update('update addresses set default_for_shipping = 0 where user_id = :id', ['id' => Auth::id() ]);
        }

        $address->update($input);

        return redirect()->route('client-addresses.index');
    }

    public function destroy($id) 
    {
        Address::findOrFail($id)->delete();

        return redirect()->route('client-addresses.index');
    }
}
