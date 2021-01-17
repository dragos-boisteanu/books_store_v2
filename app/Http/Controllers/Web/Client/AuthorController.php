<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function __invoke($id) 
    {
        $author = Author::findOrFail($id);
        $books = $author->books()->paginate(20);
        return view('client.authors.index', compact('books', 'author'));
    }
}
