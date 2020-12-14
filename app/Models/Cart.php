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


    public static function createNewCart($userId) 
    {
        if(Cart::where('session_id', session()->getId())->exists()) {
            $cart = Cart::where('session_id', session()->getId())->first();

            $cart->session_id = null;
            $cart->user_id = $userId;
        
        }else {
            $cart = new Cart();
        
            $cart->user_id = $userId;
        }

        $cart->save();
      
    }

    public static function getCart() 
    {
        if(Auth::check()) {
            $cart = Cart::where('user_id', Auth::id());
        }else {
            $cart = Cart::where('session_id', Session::getId());
        }

        return $cart ;
    }
}

