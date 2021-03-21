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
    <a>
        {{-- cart --}}
    </a>

    
</header>

@push('js-scripts')
    <script>
        const searchBarSearchInput = $('#searchBar #search');
        const searchBarResults =  $('#searchBar #results');

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
    </script>
@endpush
