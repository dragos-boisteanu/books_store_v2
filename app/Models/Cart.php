<?php

namespace App\Models;
use Exception;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;


    public function books()
    {
        return $this->belongsToMany('App\Models\Book')->withPivot('cart_id', 'book_id', 'quantity')->withTimestamps();
    }

    public function users() 
    {
        return $this->belongsTo('App\Models\User');
    }
    

    public function addItem($id) 
    {
        if(count($this->books) > 0) {
            foreach($this->books as $book) {
                
                if($book->pivot->book_id == $id) {
                    if(Book::findOrFail($book->pivot->book_id)->stock->quantity >= ( $book->pivot->quantity + 1 )) {
                        $newQuantity = $book->pivot->quantity + 1;
                        $this->books()->updateExistingPivot($book->pivot->book_id, ['quantity' => $newQuantity]);
    
                        break;
    
                    }else {
    
                        throw new Exception("Not enough products in stock");
    
                    };
                }
                // dump($book->pivot->book_id . ' ' . $id);
            }
            // dd();
        }

        $this->books()->attach($id);
        return Book::getBookFromCart($this->id, $id);
             
        
    }

    public function updateQuantity($request) 
    {
      
        if($request->has('quantity') && $request->quantity > 0) {
            foreach($this->books as $book) {
                if($book->pivot->book_id == $request->bookId) {
                    if($book->pivot->quantity != $request->quantity) {
                        if(Book::findOrFail($request->bookId)->stock->quantity >= $request->quantity) {
                            $this->books()->updateExistingPivot($request->bookId, ['quantity' => $request->quantity]);
                            
                            return;
                        }else {
                            throw new Exception("Not enough products in stock");
                        };
                    }else {
                        throw new Exception("New quantity is equal with the old quantity. Nothing to update");
                    }                
                }
            }
        }else {
            throw new Exception("Nothing to update !");
        }
    }

    public static function createNewCart() 
    {
        
        $cart = new Cart();

        $cart->session_id = session()->getId();

        $cart->save();

        session(['cartId' => $cart->fresh()->id]);
        
        return $cart;
    }


    public static function createCartForUser($userId) 
    {
        if(Cart::where('id', session('cartId'))->exists()) {
            $cart = Cart::where('id', session('cartId'))->first();

            $cart->session_id = null;

            $cart->user_id = $userId;
        
        }else {
            $cart = new Cart();
        
            $cart->user_id = $userId;

            $cart->save();

            session(['cartId' => $cart->fresh()->id]);
        }

    }

    public static function assignCart()
    {
        if(!Cart::where('user_id', Auth::id())->exists()) {
            $cart = Cart::find(session('cartId'));
            
            $cart->user_id = Auth::id();
            $cart->session_id = null;

            $cart->save();
        } else {

            $authCart = Cart::where('user_id', Auth::id())->first();
       
            $sessionCart = Cart::find(session('cartId'));

            if(count($sessionCart->books) > 0) {
                $authCart->books()->sync($sessionCart->books);
            }
          

            $sessionCart->delete();
        }     
    }

    public static function getCart() 
    {
 
        if(Auth::check() && Cart::where('user_id', Auth::id())->exists()) {
            $cart = Cart::where('user_id', Auth::id())->first();
        }else {
            $cart = Cart::find(session('cartId'));
        }
       
        return $cart;
    }
}

