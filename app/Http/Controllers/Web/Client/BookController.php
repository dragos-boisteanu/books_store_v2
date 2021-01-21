<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BookController extends Controller
{

   
    public function index() 
    {
    
        $limit = 5;

        $newBooks = Book::orderBy('created_at', 'desc')->limit($limit)->get();

        $bestSellingIds = DB::select('SELECT books.*, SUM(book_order.quantity) AS total_quantity
                                FROM book_order
                                JOIN books ON books.id = book_order.book_id
                                WHERE books.deleted_at is null
                                GROUP BY books.id
                                ORDER BY total_quantity desc
                                LIMIT :limit', ['limit'=>$limit]);

        $bestSelling = Book::hydrate($bestSellingIds);

        $mostViewdBooks = Book::orderByUniqueViews('desc')->limit($limit)->get();

        return view('home', compact('newBooks', 'bestSelling', 'mostViewdBooks'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);

        $expiresAt = now()->addHours(24);

        views($book)->cooldown($expiresAt)->record();
        
        return view('client.books.show', ['book'=>$book]);
    }

}
