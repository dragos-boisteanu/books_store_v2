@extends('layouts.app')

@section('content')

    <div id="view" class="view">
        <div class="view__content">
            {{ Breadcrumbs::render('search') }}
            <h1>Results: <span>{{ $query }}</span></h1>

            @if ( isset($books) && $books->isNotEmpty()) 
                <x-books :books="$books"></x-books>
            @else
                @if(empty($query))
                    Nothing to search for !
                @else
                    No books found !
                @endif
            @endif
           
        </div>
       
    </div>

@endsection


@push('vue-scripts')
    <script>
        new Vue({
            el: '#view',
            created() {
                console.log('vue instance created from search result page');
            },          
            
        });
    </script>
@endpush


