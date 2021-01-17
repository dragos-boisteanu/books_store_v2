{{ $books->links() }}
<ul class="list books-list">
    @foreach ($books as $book)
        <li class="book__item" >
            <a href="{{ route('books.show', ['id'=>$book->id]) }}"> 
                <div class="book__image {{ $book->stock->quantity < 1 ? 'not-in-stock' : '' }}">
                    @if ( $book->discount > 0)
                        <div class="discount__amount">
                        - {{$book->discount}} %
                        </div>
                    @endif
                    <img src="{{ $book->image_link }}" />
                </div>
                <div class="book__title">
                    <a class="link" href="{{ route('books.show', ['id'=>$book->id]) }}">{{$book->title}}</a>
                </div>
                <ul class="list book_authors">
                    @foreach($book->authors as $author)
                        <li class="author">
                            <a class="link" href="{{ route('author-books.show', ['id'=>$author->id])}}">{{ $author->first_name . ' ' . $author->name }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="book__price">
                    @if ( $book->discount > 0)
                        <div class="price__discount">
                            <div class="discounted__price">
                                {{ $book->final_price }} RON
                            </div>
                            <div class="original__price">
                                {{ $book->price }} RON
                            </div>
                        </div>
                    @else
                        <div class="original__price">
                            {{ $book->price }} RON
                        </div>
                    @endif
                </div>
    
                <div class="book__action">
                    @if ($book->stock->quantity >= 1)
                        <add-to-cart-btn-component
                            id={{$book->id}}
                        ></add-to-cart-btn-component>
                    @else 
                        <div class="stock__empty">
                            Not in stock
                        </div>
                    @endif
                </div>  
            </a>
        </li>
    @endforeach
</ul>
{{ $books->links() }}
