@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <h1>Lista produse</h1>
        <div class="filter">
            <form method="POST" action="{{ route('admin-books.index')}}">
                @csrf

                <input type="text" name="title" placeholder="Book title"/>
                <input type="text" name="author" placeholder="Author name"/>
                
                <select name="stock">
                    <option value="0" disabled selected>Alege stocul</option>
                    <option value="1">Disponibil</option>
                    <option value="2">Indisponibil</option>
                </select>

                <select name="category">
                    <option value="0" disabled selected>Alege categoria</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <label for="created_at">Adaugat intre</label>
                <input type="date" id="created_at" name="created_at_start">
                <input type="date" name="created_at_end">

                <label for="updated_at">Modificat intre</label>
                <input type="date" id="updated_at" name="updated_at_start">
                <input type="date" name="updated_at_end">

                <button type="submit">Aplica filtrul</button>

            </form>
        </div>

        <x-books-table
            :books="$books"
        ></x-books-table>

    
@endsection
