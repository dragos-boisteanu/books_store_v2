<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() 
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return response()->json($categories , 200);
    }
}
