<?php

namespace App\Http\Controllers\Web;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublisherController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $books = Publisher::findOrFail($id)->books()->orderBy('created_at','desc')->paginate(15);

        return $books;
    }
}
