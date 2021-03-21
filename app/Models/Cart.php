<?php

namespace App\Models;
use Exception;
use App\Models\Book;
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

    public function books()
    {
        return $this->belongsToMany('App\Models\Book')->withPivot('cart_id', 'book_id', 'quantity');
    }

    public function users() 
    {
        return $this->belongsTo('App\Models\User');
    }
    

    public function addItem($id) 
    {
      
        $newBook = Book::findOrFail($id);

        $bookInCart = false;

        if($newBook->stock->quantity >= 1) {
            // enough books in stock
            if(count($this->books) > 0) {
                // cart is not empty 
                foreach($this->books as $book) {
                    // search if the book in already in cart
                    if($book->pivot->book_id == $id) {
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
                $this->books()->attach($id);
            }
        } else {
            // not enough books in stock
            throw new Exception("Not enough products in stock");
        };
        
    }

}

