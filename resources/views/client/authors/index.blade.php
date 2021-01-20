@extends('layouts.app')


@section('content')
    <div id="view" class="view">
        <div class="view__content"> 
            {{ Breadcrumbs::render('author', $author) }}
            <h1><span class="capitalized">{{ $author->first_name }} {{ $author->name}}</span>'s books</h1>
            <x-books :books="$books"></x-books>
        </div>
    </div>
@endsection

@push('vue-scripts')
    <script>
        new Vue({
            el: '#view',            
        });
    </script>
@endpush
