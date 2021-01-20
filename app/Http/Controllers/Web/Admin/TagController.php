<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $tags = Tag::paginate(15);

        $tags = Tag::where( function($query) use ($request) {

            if($id = $request->id) {
                $query->where('id', $id);
            }

            if($name = $request->name) {
                $query->where('name', 'like', '%'.$name.'%');
            }

            if($creted_by = $request->created_by) {
                $query->were('created_by', $created_by);
            }

            if($updated_by = $request->updated_by) {
                $query->where('updated_by', $updated_by);
            }
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
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


        Tag::create($input);

        return redirect()->route('admin-tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);

        $books = $tag->books()->paginate(10);

        return view('admin.tags.show', compact('tag', 'books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        return view('admin.tags.edit', compact('tag'));
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
        $input = $request->all();

        $input['updated_by'] = Auth::id();

        Tag::update($input);

        return redirect()->route('admin-tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::findOrFail($id)->delete();

        return redirect()->route('admin-tags.index');
    }
}
