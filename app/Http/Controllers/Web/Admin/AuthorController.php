<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authors = Author::where( function($query) use ($request) {

            if( ($id = $request->id) ) {
                $query->where('id', $id);
            }

            if( ($firstName = $request->first_name )) {
                $query->where('first_name', 'like', '%'.$firstName.'%');
            } 

            if ( ($name = $request->name) ) {
                $query->where('name', 'like', '%'.$name.'%');
            }

            if( ($createdAtStart = $request->created_at_start) ) {
                $query->whereDate('created_at', '>', $createdAtStart);
            } 
            
            if ( ($createdAtEnd = $request->created_at_end) ) {
                $query->whereDate('created_at', '<', $createdAtEnd);
            }

            if( ($updatedAtStart = $request->updated_at_start) ) {
                $query->whereDate('updated_at', '>', $updatedAtStart);
            } 
            
            if ( ($updatedAtEnd = $request->updated_at_end) ) {
                $query->whereDate('updated_at', '<', $updatedAtEnd);
            }

        })->orderBy('authors.first_name', 'desc')->orderBy('authors.name', 'desc')->paginate(15)->withQueryString();

        $request->flash();

        return view('admin.authors.index', ['authors'=>$authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.authors.create');
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

        $input['created_by'] = Auth::id();
        $input['updated_by'] = Auth::id();

        Author::create($input);

        return redirect()->route('admin-authors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::findOrFail($id);
       
        $books = $author->books()->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.authors.show', ['author'=>$author, 'books'=>$books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::findOrFail($id);

        return view('admin.authors.edit', ['author'=>$author]);
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
        $author = Author::findOrFail($id);

        $input = $request->all();
        $input['updated_by'] = Auth::id();

        $author->update($input);

        return redirect()->route('admin-authors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Author::findOrFail($id)->delete();


        return redirect()->route('admin-authors.index');
    }
}
