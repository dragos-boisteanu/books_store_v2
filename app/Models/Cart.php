<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
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

    public function newCart() 
    {
        if(Auth::check()) {
            $this->user_id = Auth::id();
        }else {
            $this->session_id = session()->getId();
        }

        $this->save();

        return $this->fresh();

    }

    public static function getCart() 
    {
        if(Auth::check()) {
            $cart = Cart::where('user_id', Auth::id());
        }else {
            $cart = Cart::where('session_id', session()->getId());
        }

        return $cart ;
    }
}

