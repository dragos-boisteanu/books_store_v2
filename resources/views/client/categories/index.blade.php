@extends('layouts.app')

@section('content')
    <div class="view">
        <div class="view__filter">

        </div>
        <div class="view__content">
            <h1>Books in <span class="capitalized">{{ $category->name }}</span></h1>
            <x-books :books="$books"></x-books>
        </div>
    </div>
@endsection