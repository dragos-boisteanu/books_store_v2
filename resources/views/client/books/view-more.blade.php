@extends('layouts.app')

@section('content')
    <div id="view" class="view">
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

@push('vue-scripts')
    <script>
        new Vue({
            el: '#view',
            created() {
                console.log('vue instance created from more page');
            },          
            
        });
    </script>
@endpush
