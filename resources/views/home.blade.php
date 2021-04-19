@extends('layouts.app')

@section('content')
<div id="view" class="view">
    <div class="view__content home">
        {{ Breadcrumbs::render('home') }}
        <div class="home__group">
            <h1>Recently added</h1>
            <x-books :books="$newBooks" id="ra"></x-books>
        </div>

        <div class="home__group">
            <h1>Best selling</h1>
            <x-books :books="$bestSelling" id="bs"></x-books>
        </div>
        
        <div class="most-viewd">
            <h1>Most Viewd</h1>
            <x-books :books="$mostViewdBooks" id="ms"></x-books>
        </div>
       
    </div>
</div>
@endsection

@push('js-scripts')
    <script>
        const addToCartBtns = $('.add-to-cart');

        addToCartBtns.each( (index, item) => {
            item.addEventListener('click', function (e) { 
                addToCart(item.id);
            });
        })
    </script>
@endpush
