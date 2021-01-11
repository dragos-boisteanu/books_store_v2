<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request) 
    {

        $books = Book::where(function($query) use ($request) {
            if( ($q = $request->q) ) {
                $query->where('title', 'like', '%'. $q . '%');
            }
        })->orderBy('created_at', 'desc')->limit(5)->get();

        return response()->json($books, 200);
    }
}
