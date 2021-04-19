<?php

namespace App\Models;
use Exception;
use App\Models\Book;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
    ];

    protected $with = ['books'];
    protected $appends = array('booksCount');

    public function books()
    {
        return $this->belongsToMany('App\Models\Book')->withPivot('book_id', 'quantity');
    }

    public function users() 
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getBooksCountAttribute() 
    {
        $books = $this->books;
        $qunaity = 0;
        foreach($books as $book) {
            $qunaity += $book->pivot->quantity;
        }

        return $qunaity;
        
    }
    

    public function addItem($bookdId) 
    {
      
        $newBook = Book::findOrFail($bookdId);

        $bookInCart = false;

        if($newBook->stock->quantity >= 1) {
            // enough books in stock
            if(count($this->books) > 0) {
                // cart is not empty 
                foreach($this->books as $book) {
                    // search if the book in already in cart
                    if($book->pivot->book_id == $bookdId) {
                        // the book is in cart
                        $bookInCart = true;
                        $newQuantity = $book->pivot->quantity + 1;
                        $this->books()->updateExistingPivot($book->pivot->book_id, ['quantity' => $newQuantity]);
                        break;
                    }
                }
            }
            
            if(!$bookInCart) {
                // cart empy or the book is not already in cart
                //add book in cart
                $this->books()->attach($bookdId);
            }
        } else {
            // not enough books in stock
            throw new Exception("Not enough products in stock");
        };
        
    }

}

