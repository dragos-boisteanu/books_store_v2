<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class CategoriesComposer 
{
   private $categories;

   public function compose(View $view)
   {
      $this->categories = Category::all();
      $view->with('categories', $this->categories);
   }
}
