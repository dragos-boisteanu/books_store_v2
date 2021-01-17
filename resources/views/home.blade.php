@extends('layouts.app')

@section('content')
<div id="view" class="view">
    <div class="view__content home">
        <div class="carrousel">
            test
        </div>
        <div class="home__group">
            <h1>Recently added</h1>
            <x-books :books="$newBooks"></x-books>
            <div class="see__more">
                <a class="link" href="{{ route('books-new.show') }}">See more</a>
            </div>
        </div>

        <div class="home__group">
            <h1>Best selling</h1>
            <x-books :books="$mostSoldBooks"></x-books>
            <div class="see__more">
                <a class="link" href="/">See more</a>
            </div>
        </div>
        <div class="most-viewd">
            <h1>Most Viewd</h1>
            <x-books :books="$mostViewdBooks"></x-books>
            <div class="see__more">
                <a class="link" href="/">See more</a>
            </div>
        </div>
       
    </div>
</div>
@endsection

@push('vue-scripts')
    <script>
        new Vue({
            el: '#view',
            created() {
                console.log('vue instance created from home page');
            },          
            
        });
    </script>
@endpush
