<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;


    public function books()
    {
        return $this->belongsToMany('App\Models\Book')->withPivot('cart_id', 'book_id', 'quantity');
    }

    public function users() 
    {
        return $this->belongsTo('App\Models\User');
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
        }

        $cart->save();

        session(['cartId' => $cart->fresh()->id]);
      
    }

    public static function assignedCart()
    {
        $cart = Cart::getCart();

        $cart->user_id = Auth::id();
        $cart->session_id = null;

        $cart->save();
    }

    public static function getCart() 
    {
 
        $cart = Cart::findOrFail(session('cartId'));

        return $cart;
    }
}

