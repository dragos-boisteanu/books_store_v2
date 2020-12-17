<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{

    public function find(Request $request) 
    {
        $authors = Author::where('first_name', 'like', $request->input('data').'%')
                        ->orWhere('name', 'like', $request->input('data').'%')->get();
        
        return response()->json([
            'message'=>$authors
        ], 200);
    }

    public function check(Request $request)
    {
        if(Author::where('first_name', '=', $request->input('first_name'))->where('name', '=', $request->input('name'))->exists()) {
            return response()->json([
                'status' => "exists"
            ],200);
        }else{
            return response()->json([
                'status' => "ok"
            ], 200);
        }
    }
}
