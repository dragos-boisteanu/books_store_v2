<header id="header" class="header">
    <a href="{{ route('home') }}" class="link link--logo logo">
        <img class="logo__img" src=""/>
        <span class="logo__text">Books Store</span>
    </a>
    <div id="searchBar" class="search-bar">
        <form id="searchForm" method="GET" action="{{ route('search') }}" class="search-bar__form">
            <input type="text" id="search" class="search-bar__input" placeholder="Search books" name="q">
            <button for="search" class="button button-primary search-bar__button">
                <img class="button__image" src="/storage/icons/search.svg"/>
            </button>
        </form>
        <ul id="results" class="list search-bar__results"> 
        </ul>
    </div>
    <div></div>
    <div id="cart" class="cart">
        <div id="cartCount" class="cart__count">
            {{ $cart->booksCount }}
        </div>
        <button id="cartBtn" class="button cart__button">
            <img src="/storage/icons/cart.svg"/>
        </button>
        <div id="cartContent" class="cart__content" style="display: none">
            <div class="cart__header">
                <div>
                    Cart 
                </div>
                <button id="closeCartBtn" class="button">
                    <img src="/storage/icons/close.svg"/>
                </button>
            </div>
            <ul id="itemsList" class="items__list">
                @foreach($cart->books as $book)
                    <li id="{{ $book->id }}" class="item">
                        <a href="/" class="link title">{{ $book->title }}</a>
                        <div class="quantity">
                            <span class="divider">x</span>
                            <span class="value">{{ $book->pivot->quantity }} buc</span>
                        </div>
                        <div class="price">{{ $book->finalPrice }} RON</div>
                        <button id="delete{{ $book->id }}" class="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                            </svg>
                        </button>
                    </li>
                @endforeach
                {{-- <li class="item">
                    <a :href="'/books/' + book.id" class="link title">{{ book.title }}</a>
                    <div class="quantity">
                        <span class="divider">x</span>
                        <span class="value">{{ book.quantity }} buc.</span>
                    </div>
                    <div class="price">{{ book.finalPrice }} RON</div>
                    
                </li> --}}
            </ul>
        </div>
       
    </div>
</header>

@push('js-scripts')
    <script>
        const cart = $('#header #cart');
        const cartCount =$('#header #cart #cartCount');
        const cartBtn = $('#header #cart #cartBtn');
        const cartContent = $('#header #cart #cartContent');
        const cartItems = $('#header #cart #cartContent #itemsList')
        const closeCartBtn = $('#header #cart #cartContent #closeCartBtn');
        const removeItemBtns = $('#header #cart #cartContnet #cartItems .delete-btn');

        const itemsList = $('#header #cart #cartContent #itemsList .item');
        const itemsIdList = [];

        const searchBarSearchInput = $('#header #searchBar #search');
        const searchBarResults =  $('#header #searchBar #results');

        itemsList.each( (index, item) => {
            itemsIdList.push(item.id);
            removeFromCart(item);
            
        })

        // SEARCH BAR START
        searchBarSearchInput.keyup(function (e) {
            searchBooks();
        });   

        // close results list when clicking outside of it
        $(document).click(function(event){
            if(!$(event.target).closest("#searchBar #results").length){
                closeSearchResults();
            }
        });

        searchBooks = _.debounce( function() {
            if(searchBarSearchInput[0].value.length > 0) {
                searchBarResults.empty();
                $.get( "api/search", { q: searchBarSearchInput[0].value } )
                .done(function( data ) {
                    searchBarSearchInput.addClass('search-bar--results');
                    if(data.length > 0) {
                        data.forEach(result => {
                            searchBarResults.append(
                                `
                                    <li class="result">
                                        <div class="title__authors">
                                            <a class="link result__title" href="/books/${result.id}">${result.title}</a>
                                            <ul class="list list-horizontal">
                                                ${generateAuthorsList(result.authors)}
                                            </ul>
                                        </div>
                                        <div class="result__price">
                                            ${result.price} RON
                                        </div>
                                    </li>
                                `
                            );
                        });
                    } else {
                        searchBarResults.append('<li class="result">No books found</li>')
                    }
                    searchBarResults.slideDown();
                });
            }else {
                closeSearchResults();
            }
        }, 500)

        function closeSearchResults() {
            searchBarResults.slideUp('medium', function () {
                searchBarSearchInput.removeClass('search-bar--results');
                searchBarResults.empty();
            });
           
        }
        
        function generateAuthorsList(data) {
            let authors = '';
            data.forEach(item => {
                authors += 
                `
                <li class="result__author">
                    <a class="link" href="/authors/${item.id}">${item.name}</a>
                </li>
                `
            });
            return authors;
        }

        // SEARCH BAR END

        // CART START

        closeCart = () => {
            cartBtn.show();
            cartContent.hide();
            cartCount.show();
        }
        
        cartContent.click(function() {
            closeCart()
        })

        cartBtn.click(function (e) { 
            cartBtn.hide();
            cartContent.show();
            cartCount.hide();
        });

        closeCartBtn.click(function (e) {
            closeCart()
        });



        // CART END

    </script>
@endpush
