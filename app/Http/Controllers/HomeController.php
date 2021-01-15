<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $books = Book::orderBy('created_at', 'desc')->simplePaginate(15);
        $newBooks = Book::orderBy('created_at', 'desc')->limit(5)->get();

        return view('home', compact('newBooks'));
    }
}
