@extends('layouts.app')

@section('content')
    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
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

                <div class="actions">
                    <a class="link" href="{{ route('admin-authors.edit', ['author'=>$author->id]) }}">Edit</a>
                    <form  method="POST" action="{{ route('admin-authors.destroy', ['author'=>$author->id]) }}">
                        @csrf
                        @method('DELETE')
        
                        <button type="submit" class="button button-primary">Delete</button>
                    </form>
                </div>
    
                
            </div>
        </div>
    </div>
@endsection