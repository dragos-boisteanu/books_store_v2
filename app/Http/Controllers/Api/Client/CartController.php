<?php

namespace App\Http\Controllers\Api\Client;

use Exception;
use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BookCartResource;
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

    public function store(Request $request) 
    {
        $bookdId = $request->bookId;
        try {
            if(auth()->id()) {
                $cart = Cart::where('user_id', auth()->id())->first();
            } else {
                $cart = Cart::where('session_id', session()->getId())->first();
            }

            if(isset($cart)) {
                $cart->addItem($bookdId);
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
                $cart->addItem($bookdId);
            }

            $cart->refresh();

            $book = $cart->books->where('id', $bookdId)->first();
            $bookResource = new BookCartResource($book);

            return response()->json([
                'message' => 'Book added into cart', 
                'booksCount' => $cart->booksCount,
                'book'=> $bookResource, 
            ], 200);

        } catch ( ModelNotFoundException $mfe) {
            return response()->json("Book not found", 404);

        }         
        
    }

    public function removeItem($id) 
    {
        if(auth()->id()) {
            $cart = Cart::where('user_id', auth()->id())->first();
        } else {
            $cart = Cart::where('session_id', session()->getId())->first();
        }

        $cart->books()->detach($id);

        $cart->refresh();

        return response()->json([
            'message'=>'Book removed!',
            'booksCount' => $cart->booksCount,
        ],200);
    }


    public function destroy() 
    {
        if(auth()->id()) {
            $cart = Cart::where('user_id', auth()->id())->first();
        } else {
            $cart = Cart::where('session_id', session()->getId())->first();
        }

        $cart->books()->detach();

        return response()->json([
            'message' => 'Car was clear!'
        ], 200);
        
    }

}
