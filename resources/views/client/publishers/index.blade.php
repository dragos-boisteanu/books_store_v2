@extends('layouts.app')

@section('content')
    <div class="view">
        <div class="view__content">
            {{ Breadcrumbs::render('publisher', $publisher) }}
            <h1>Books from <span class="capitalized">{{ $publisher->name }}</span></h1>
            <x-books :books="$books"></x-books>
        </div>
    </div>
@endsection