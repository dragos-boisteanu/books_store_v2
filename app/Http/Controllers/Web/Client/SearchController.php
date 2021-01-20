<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request) 
    {
        if(!empty($request->q)) {
            $books = Book::where('title', 'like', '%'. $request->q . '%')
                    ->orderBy('created_at', 'desc')
                    ->simplePaginate(15)
                    ->withQueryString();

            return view('client.books.search', ['books'=>$books, 'query'=>$request->q]);
        } else {
            return view('client.books.search', ['query'=>$request->q]);
        }

      
        
    
       
    }
}
