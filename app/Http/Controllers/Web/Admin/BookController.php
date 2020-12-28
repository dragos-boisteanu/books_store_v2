<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Book;
use App\Models\Cover;
use App\Models\Stock;
use App\Models\Author;
use App\Models\Category;
use App\Models\Language;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
               
      
        $books =  Book::where( function($query) use ($request) {

            if( ($title = $request->title) ) {
                $query->where('title', 'like', '%'. $title .'%');
            }


            if( ( $createdBy = $request->created_by) ) {
                $query->where('created_by', $createdBy);
            }

            if( ($updatedBy = $request->updated_by) ) {
                $query->where('updated_by', $updatedBy);
            }


            if( ($stock = $request->stock) ) {
                if($stock == 1) {
                    $query->whereHas('stock', function($query) use ($stock) {
                        $query->where('quantity', 0);
                    });
                } else {
                    $query->whereHas('stock', function($query) use ($stock) {
                        $query->where('quantity', '>', 0);
                    });
                }
            }

            if( ($authorFirstName = $request->author_first_name) ) {
               $query->whereHas('authors', function($query) use ($authorFirstName){
                    $query->where('first_name', 'like', '%' . $authorFirstName . '%');
               });
            } else if ( ($authorName = $request->author_name) ) {
                $query->whereHas('authors', function($query) use ($authorName){
                    $query->where('name', 'like', '%' . $authorName . '%');
               });
            }else if( ($authorFirstName = $request->author_first_name) && ($authorName = $request->author_name) ){
                $query->whereHas('authors', function($query) use ($authorName, $authorFirstName){
                    $query->where('first_name', 'like', '%' . $authorFirstName . '%')
                        ->where('name', 'like', '%' . $authorName . '%');
               });
            }



            if( ($categoryId = $request->category) ) {
                $query->whereHas('category', function($query) use ($categoryId) {
                    $query->where('id', $categoryId);
                });
            };





            if( ($createdAtStart = $request->created_at_start) ) {
                
                $query->whereDate('created_at', '>', $createdAtStart);

            } else if ( ($createdAtEnd = $request->created_at_end) ) {
                $query->whereDate('created_at', '<', $createdAtEnd);
                

            }else if ( ($createdAtStart = $request->created_at_start) && ($createdAtEnd = $request->created_at_end) ) {
                $query->whereDate('created_at', '>', $createdAtStart)
                    ->whereDate('created_at', '<', $createdAtEnd);
            }




            if( ($updatedAtStart = $request->updated_at_start) ) {
                $query->whereDate('updated_at', '>', $updatedAtStart);
                
            } else if ( ($updatedAtEnd = $request->updated_at_end) ) {
                $query->whereDate('updated_at', '<', $updatedAtEnd);
          
            }else if ( ($updatedAtStart = $request->updated_at_start) && ($updatedAtEnd = $request->updated_at_end) ) {
                $query->whereDate('updated_at', '>', $updatedAtStart)
                    ->whereDate('updated_at', '<', $updatedAtEnd);
            }



        })->orderBy('books.created_at', 'desc')->simplePaginate(15)->withQueryString();
 
        $categories = Category::all();

        $request->flash();

        return view('admin.books.index', ['books'=>$books, 'categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        $covers = Cover::all();
        $languages = Language::all();
        $publishers = Publisher::all();
        
        return view('admin\books\create',  [
                                            'authors'=>$authors,
                                            'categories'=>$categories,
                                            'covers' => $covers, 
                                            'languages' => $languages, 
                                            'publishers' => $publishers
                                            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $input['created_by'] = Auth::user()->id;
        $input['updated_by'] = Auth::user()->id;

        if ( !isset($input['discount']) ) {
            $input['discount'] = 0;
        }      
        
        $book = Book::create($input);

        $stock = new Stock();

        $stock->book_id = $book->id;
        $stock->quantity = $input['quantity'];
        $stock->created_by = Auth::user()->id;
        $stock->updated_by = Auth::user()->id;

        $stock->save();

        $authorsArray = json_decode($input['authors']);
        $authorsIds = array_column($authorsArray, 'id');
        $book->authors()->sync($authorsIds);

        $tagsArray = json_decode($input['tags']);
        $tagsIds = array_column($tagsArray, 'id');
        $book->tags()->sync($tagsIds);


        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('admin.books.show', ['book'=>$book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        $categories = Category::all();
        $covers = Cover::all();
        $languages = Language::all();
        $publishers = Publisher::all();

        return view('admin.books.edit',  [
                                            'categories'=>$categories,
                                            'covers' => $covers, 
                                            'languages' => $languages, 
                                            'publishers' => $publishers,
                                            'book'=> $book
                                        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $input = $request->all();

        $input['updated_by'] = Auth::user()->id;

        if($input['quantity'] != $book->stock->quantity) {
            $book->stock->quantity = $input['quantity'];
            $book->stock->updated_by = Auth::user()->id;
            $book->stock->save();
        }
    
        $book->update($input);

        $authorsArray = json_decode($input['authors']);
        $authorsIds = array_column($authorsArray, 'id');
        $book->authors()->sync($authorsIds);

        $tagsArray = json_decode($input['tags']);
        $tagsIds = array_column($tagsArray, 'id');
        $book->tags()->sync($tagsIds);

       
        return redirect()->route('admin-books.show', ['book'=>$book->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete();

        return redirect()->route('books.index');
    }
}
