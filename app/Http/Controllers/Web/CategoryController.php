<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $books = Category::findOrFail($id)->books()->orderBy('created_at','desc')->get();

        return $books;
    }
}
