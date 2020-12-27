<?php

namespace App\Http\Controllers\Web\Client;

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
        })->simplePaginate(15);

        return view('client.books.search', ['books'=>$books, 'query'=>$request->q]);
    }
}
