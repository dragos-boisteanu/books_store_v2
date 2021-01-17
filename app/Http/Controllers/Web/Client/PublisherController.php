<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublisherController extends Controller
{
    public function __invoke($id)
    {
        $publisher = Publisher::findOrFail($id);
        $books = $publisher->books()->paginate(20);

        return view('client.publishers.index', compact('books', 'publisher'));
    }
}
