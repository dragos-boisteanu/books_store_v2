<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{

    public function store(Request $request)
    {
        
        $input = $request->all();

        $input['created_by'] = Auth::user()->id;
        $input['updated_by'] = Auth::user()->id;

        $tag = Tag::create($input);

        return response()->json([
            'message' => $tag
        ], 200);
        
    }

    public function find(Request $request) 
    {
        $tags = Tag::where('name', 'like', $request->input('data').'%')->get();
        
        return response()->json([
            'message'=>$tags
        ], 200);
    }

    public function check(Request $request)
    {
        if(Tag::where('name', '=', $request->input('name'))->exists()) {
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
