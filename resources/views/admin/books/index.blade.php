@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <h1>Lista produse</h1>
        <div class="filter">
            <form method="GET" action="{{ route('admin-books.index')}}">

                <input type="text" name="title" placeholder="Book title" value="{{ old('title')}}"/>
                <input type="text" name="author_first_name" placeholder="Author first name" value="{{ old('author_first_name')}}" />
                <input type="text" name="author_name" placeholder="Author name" value="{{ old('author_name')}}"/>

                <input type="number" name="created_by" placeholder="User id" value="{{ old('created_by')}}"/>

                <input type="number" name="updated_by" placeholder="User id" value="{{ old('updated_by')}}"/>

                <select name="stock">
                    <option value="0" disabled selected>Stock</option>
                    <option value="1">Unavailable</option>
                    <option value="2">Available</option>
                </select>

                <select name="category">
                    <option value="0" disabled selected>Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <label for="created-at-after">Added after</label>
                <input type="date" id="created-at-after" name="created_at_start">

                <label for="created-at-before">Added before</label>
                <input type="date" id="created-at-before" name="created_at_end">

                <label for="updated-at-after">Updated after</label>
                <input type="date" id="updated-at-after" name="updated_at_start">

                <label for="updated-at-before">Updated before</label>
                <input type="date" id="updated-at-before" name="updated_at_end">

                <button type="submit">Filter</button>

            </form>

            <form method="GET" action="{{ route('admin-books.index')}}">
                <button>Clear</button>
            </form>
        </div>

        <x-books-table
            :books="$books"
        ></x-books-table>

    
@endsection
