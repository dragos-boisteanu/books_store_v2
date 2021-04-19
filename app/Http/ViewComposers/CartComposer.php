<?php

namespace App\Http\ViewComposers;

use App\Models\Cart;
use Illuminate\View\View;

class CartComposer 
{
   private $cart;

   public function compose(View $view)
   {
      if(auth()) {
         $this->cart = Cart::where('user_id', auth()->id())->first();
      } else {
         $this->cart = Cart::where('session_id', session()->getId())->first();
      }
      $view->with('cart', $this->cart);
   }
}
