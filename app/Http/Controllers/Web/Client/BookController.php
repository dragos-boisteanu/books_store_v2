<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index() 
    {

    }

    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('client.books.show', ['book'=>$book]);
    }
}
