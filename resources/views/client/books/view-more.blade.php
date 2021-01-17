@extends('layouts.app')

@section('content')
    <div class="view">
        <div class="filter">

        </div>
        <div class="view__content">
            <h1>
                {{ $title }}
            </h1>
            {{ $books->links() }}
            <x-books :books="$books"></x-books>
            {{ $books->links() }}
        </div>
    </div>

@endsection