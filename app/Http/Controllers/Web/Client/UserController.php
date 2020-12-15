<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show() 
    {
        $user = Auth::user();

        return view('client.index', ['user'=>$user]);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        if($request->has('first_name')) {
            $user->first_name = $request->first_name;
        }

        if($request->has('name')) {
            $user->name = $request->name;
        }

        if($request->has('email')) {
            $user->email = $request->email;
        }

        if($request->has('phone_number')) {
            $user->phone_number = $request->phone_number;
        }

        if($request->has('password')) {
            if(Hash::check($user->password, $request->current_password)) {
                $user->password = Hash::make($request->password);
            } 
        }

        $user->save();
        $user->refresh();

        return view('client.index', ['user'=>$user]);
    }

}
