@extends('layouts.app')

@section('content')
<div class="view">
    @include('includes.dashboard-nav')

    <div class="view__content"> 
        <h1>
            {{ $book->id }} - {{ $book->title}} 
        </h1>
        
        <div>
            <h3>Authors</h3>
            <ul>
                @foreach ($book->authors as $author)
                    <li>
                        <a href="{{ route('admin-authors.show', ['author'=>$author->id])}} ">{{ $author->first_name }} {{ $author->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
       

        <div>
            <h3>Tags</h3>
        </div>
        <ul>
            @foreach ($book->tags as $tag)
                <li>
                    {{ $tag->id }} - {{ $tag->name }}
                </li>
            @endforeach
        </ul>
        </div>

        <div>
            <h3>Category</h3>
            <div>
                <a href="/">{{ $book->category->name }}</a>
            </div>
        </div>

        <div>
            <h3>Language</h3>
            <div>
                {{ $book->language->name }}
            </div>
        </div>
        

        <div>
            <h3>
                Description
            </h3>
            <div>
                {!! nl2br($book->description) !!}
            </div>
        </div>


        <div>
            <h3>Quantity</h3>
            <div>
                <span>Quantity:</span>
                {{ $book->stock->quantity }}
            </div>
        </div>

        <div>
            <h3>Dates</h3>
            <div>
                <span>Last updated at:</span>
                {{ $book->stock->updated_at }}
            </div>
            <div>
                <span>Last updated by:</span>
                {{ $book->stock->updated_by }}
            </div>
        </div>
        <div>
            <h3>Users</h3>
            <div>
                <span>Added by</span>
                {{ $book->added_by }}
                <span> - at {{ $book->created_at }}</span>
            </div>
            <div>
                <span>Last updated by:</span>
                {{ $book->updated_by }}
                <span> - at {{ $book->updated_at }}</span>
            </div>
        </div>



        <div>
            <h3>Actions</h3>
            <div>
                <a href="{{ route('admin-books.edit', ['book' => $book->id]) }}">Edit</a>
            </div>
    
            <div>
                <a href="{{ route('admin-books.index') }}">Inapoi</a>
            </div>
    
            <div>
                <form method="POST" action="{{ route('admin-books.destroy', ['book' => $book->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Sterge</button>
                </form>
            </div>
        </div>
        
    </div>  
</div>
    
@endsection 

