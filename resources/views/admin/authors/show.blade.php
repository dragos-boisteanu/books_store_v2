@extends('layouts.app')

@section('content')
    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            {{ Breadcrumbs::render('dashboard-authors.show', $author) }}
            <h1>
                Author #{{ $author->id }}
            </h1>
            <div>
                <ul class="details">
                    <li class="detail">
                        <span class="name">
                            First name:
                        </span>
                        <span class="value">
                            {{ $author->first_name }}
                        </span>
                    </li>
                    <li class="detail">
                        <span class="name">
                            Name:
                        </span>
                        <span class="value">
                            {{ $author->name }}
                        </span>
                    </li>
                </ul>
                
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