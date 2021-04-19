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
                $.post(`api/carts`, {
                    bookId: item.id
                })
                .done(data => {
                    const book = data.book;
                    let itemExists = false;
                    console.log(itemsIdList)
                    itemsIdList.forEach(id => {
                        if(parseInt(id) === book.id) {
                            itemExists = true;
                        }
                    });

                    const content =  
                    `
                        <a href="/" class="link title">${ book.title }</a>
                        <div class="quantity">
                            <span class="divider">x</span>
                            <span class="value">${ book.quantity } buc</span>
                        </div>
                        <div class="price">${ book.finalPrice } RON</div>
                    `;

                    if(itemExists) {
                        const item = $(`#header #cart #cartContent #itemsList #${book.id}`).detach();
                        item.html(content)
                        cartItems.append(item);
                    } else {
                        const item = document.createElement('li');
                        item.classList.add('item');
                        item.id = book.id;
                        item.innerHTML = content;
                        cartItems.append(item);
                        itemsIdList.push(book.id);
                    }

                    const cartCountValue = cartCount.html();
                    const newCartContValue = parseInt(cartCountValue) + 1

                    cartCount.detach();
                    cartCount.html(`${newCartContValue}`);
                    cart.append(cartCount)
                })
                .fail( (jqXHR, textStatus, errorThrown) => {
                    console.log(errorThrown)
                })
            });
        })
    </script>
@endpush
