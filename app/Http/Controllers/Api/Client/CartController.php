<?php

namespace App\Http\Controllers\Api\Client;

use Exception;
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

        if(!Auth::check() && !Cart::where('session_id', session()->getId())->exists()) {
            $cart = Cart::createNewCart();
            $books = Book::getBooksFromCart($cart->id); 
        }else{
            $books = Book::getBooksFromCart(Cart::getCart()->id); 
        }
        
        return response()->json([
            'cart'=> $books
        ], 200);
    }


    public function update(Request $request) 
    {
        $cart = Cart::getCart();

        try {
            $cart->updateQuantity($request);
            return response()->json([
                'message' => 'Quantity updated successfully !' 
            ], 200);
        }catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage(),
                'zero' => strpos($ex->getMessage(), '0') > -1 ? true : false
            ], 412);
        }                    
    }

    public function addItem($id) 
    {
        $cart = Cart::getCart();

        try {
            $cart->addItem($id);

            return response()->json([
                'message' => 'Book added in cart'
            ], 200);

        } catch ( Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 412);
        }
        
    }

    public function removeItem(Request $request) 
    {
        $cart = Cart::getCart();

        $cart->books()->detach($request->id);

        return response()->json([
            'message' => 'The book was removed from cart'
        ], 200);
    }


    public function empty() 
    {
        $cart = Cart::getCart();

        $cart->delete();

        return response()->json([
            'message' => 'Cart is empty !'
        ], 200);
        
    }

}
