<?php

namespace App\Http\Controllers\Api\Client;

use Exception;
use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartController extends Controller
{
    public function show() 
    {

    }


    public function update(Request $request) 
    {
       
    }

    public function store($id) 
    {
        try {
            if(auth()->id()) {
                $cart = Cart::where('user_id', auth()->id())->first();
            } else {
                $cart = Cart::where('session_id', session()->getId())->first();
            }

            if(isset($cart)) {
                $cart->addItem($id);
            } else {
                if(auth()->id()) {
                    $cart = Cart::create([
                        'user_id'=> auth()->id()
                    ]);
                } else {
                    $cart = Cart::create([
                        'session_id'=> session()->getId()
                    ]);
                }
                session()->put('cartId', $cart->id);
                $cart->addItem($id);
            }

            return response()->json("Book added into cart", 200);

        } catch ( ModelNotFoundException $mfe) {
            return response()->json("Book not found", 404);

        } 
        // catch ( \Exception $ex) {
        //     // return response()->json($ex->getMessage(), 200);
        // }
        
        
    }

    public function getItem($id) 
    {
       
    }

    public function removeItem(Request $request) 
    {
      
    }


    public function destroy() 
    {
        $cart = Cart::getCart();

        $cart->delete();

        return response()->json([
            'message' => 'Cart is empty !'
        ], 200);
        
    }

}
