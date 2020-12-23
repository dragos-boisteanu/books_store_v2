@extends('layouts.app')

@section('content')

    <div>
        <h1>
            Author #{{ $author->id }}
        </h1>
        <div>
            <div>
                <label for="first-name">First name:</label>
                <div id="first-name">
                    {{ $author->first_name }}
                </div>
            </div>

            <div>
                <label for="name">Name:</label>
                <div id="name">
                    {{ $author->name }}
                </div>
            </div>


            <x-books-table
                :books="$books"
            ></x-books-table>


            <div>
                <a href="{{ route('admin-authors.edit', ['author'=>$author->id]) }}">Edit</a>
            </div>

            <form  method="POST" action="{{ route('admin-authors.destroy', ['author'=>$author->id]) }}">
                @csrf
                @method('DELETE')

                <button type="submit">Delete</button>
            </form>
        </div>
    </div>
@endsection