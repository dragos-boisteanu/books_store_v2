@extends('layouts.app')

@section('content')
    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            <h1>
                Tag  - {{ $tag->name }} - #{{ $tag->id }}  <a class="link" href="{{ route('admin-tags.edit', ['tag'=>$tag->id]) }}">Edit</a>
            </h1>
            <div>
                <x-books-table
                    :books="$books"
                ></x-books-table>
            </div>
        </div>
    </div>
@endsection