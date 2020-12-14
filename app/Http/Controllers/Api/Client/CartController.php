<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class CartController extends Controller
{
    public function show() 
    {

        $books = Book::getBooksFromCart($this->getCart()->id); 

        return response()->json([
            'cart'=> $books
        ], 200);
    }


    public function update(Request $request) 
    {
        $cart = $this->getCart();

        if($request->has('quantity') && $request->qunatity > 0) {
            foreach($cart->books as $book) {
                if($book->pivot->book_id === $request->bookId) {
                    if(Book::findOrFail($book->pivot->book_id)->stock->quantity >= $request->qunatity) {

                        $book->pivot->quantity = $request->quantity;

                        return response()->json([
                            'message' => 'Quantity updated successfully !' 
                        ], 200);

                    }else {

                        return response()->json([
                            'message' => 'Not enough products in stock'
                        ], 412);
                    };
                }
            }
        }
    }

    public function addItem($id) 
    {
        $cart = $this->getCart();

        // Book::findOrFail($id)->stock->quantity >= ( $book->pivot->quantity + 1 );

        foreach($cart->books as $book) {
            if($book->pivot->book_id == $id) {
                if(Book::findOrFail($book->pivot->book_id)->stock->quantity >= ( $book->pivot->quantity + 1 )) {
                   
                    $newQuantity = $book->pivot->quantity + 1;
                    $cart->books()->updateExistingPivot($book->pivot->book_id, ['quantity' => $newQuantity]);

                    break;

                }else {

                    return response()->json([
                        'message' => 'Not enough products in stock'
                    ], 412);

                };
            }else {
                $cart->books()->attach($id);

                break;
            }
        }
        
        return response()->json([
            'message' => 'Book added in cart'
        ], 200);
      
    }

    public function removeItem($id) 
    {
        $cart = $this->getCart();

        $cart->books->detach($id);

        return response()->json([
            'message' => 'The book was removed from cart'
        ], 200);
    }


    public function empty() 
    {
        $cart = $this->getCart();

        $cart->delete();

        return response()->json([
            'message' => 'Cart is empty !'
        ], 200);
        
    }

    private function getCart() 
    {
        if(Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
        }else {
            $cart = Cart::where('session_id', session()->getId());
        }

        return $cart;
    }
}
