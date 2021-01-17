<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $limit = 5;

        $newBooks = Book::orderBy('created_at', 'desc')->limit(5)->get();

        $mostSoldBooksIds = DB::select('SELECT books.*, SUM(book_order.quantity) AS total_quantity
                                FROM book_order
                                JOIN books ON books.id = book_order.book_id
                                GROUP BY books.id
                                ORDER BY total_quantity desc
                                LIMIT :limit', ['limit'=>$limit]);

        $mostSoldBooks = Book::hydrate($mostSoldBooksIds);

        $mostViewdBooks = Book::orderByUniqueViews('desc')->limit($limit)->get();

        return view('home', compact('newBooks', 'mostSoldBooks', 'mostViewdBooks'));
    }
}
