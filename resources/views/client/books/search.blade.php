@extends('layouts.app')

@section('content')

    <div id="view" class="view">
        <div class="view__content">
            {{ Breadcrumbs::render('search') }}
            <h1>Results: <span>{{ $query }}</span></h1>

            <x-books :books="$books"></x-books>
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


