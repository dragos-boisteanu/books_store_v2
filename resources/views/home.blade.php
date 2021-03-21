@extends('layouts.app')

@section('content')
<div id="view" class="view">
    <div class="view__content home">
        {{ Breadcrumbs::render('home') }}
        <div class="home__group">
            <h1>Recently added</h1>
            <x-books :books="$newBooks"></x-books>
        </div>

        <div class="home__group">
            <h1>Best selling</h1>
            <x-books :books="$bestSelling"></x-books>
        </div>
        
        <div class="most-viewd">
            <h1>Most Viewd</h1>
            <x-books :books="$mostViewdBooks"></x-books>
        </div>
       
    </div>
</div>
@endsection

@push('js-scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const addToCartBtns = $('.add-to-cart');
        addToCartBtns.each( (index, item) => {
            item.addEventListener('click', function (e) { 
                $.post(`api/carts/${this.id}`)
                .done(data => {
                    console.log(data);
                })
                .fail( (jqXHR, textStatus, errorThrown) => {
                    console.log(errorThrown)
                })
            });
        })
    </script>
@endpush
