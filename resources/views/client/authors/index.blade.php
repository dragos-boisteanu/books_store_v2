@extends('layouts.app')


@section('content')
    <div class="view">
        <div class="view__filter">

        </div>
        <div class="view__content">
            <h1><span class="capitalized">{{ $author->first_name }} {{ $author->name}}</span>'s books</h1>
            <x-books :books="$books"></x-books>
        </div>
    </div>
@endsection