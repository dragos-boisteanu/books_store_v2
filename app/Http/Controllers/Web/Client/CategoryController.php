<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __invoke($id)
    {
        $category = Category::findOrFail($id);
        $books = $category->books()->paginate(20);

        return view('client.categories.index', compact('books', 'category'));
    }
}
