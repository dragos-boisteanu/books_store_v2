<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class CartComposer 
{
   private $cart;

   public function compose(View $view)
   {
      $this->cart = Category::all();
      $view->with('cart', $this->cart);
   }
}
