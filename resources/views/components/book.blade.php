<div class="book_title">
    <a href="{{ route('books-client.show', ['id'=>$book->id]) }}">{{$book->title}}</a>
</div>
<ul class="list book_authors">
    @foreach($book->authors as $author)
        <li class="author">
            <a href="/{{ $author->id }}">{{ $author->first_name . ' ' . $author->name }}</a>
        </li>
    @endforeach
</ul>
@if($book->discount > 0)
    <div class="discount__mark">
        {{ $book->discount }}
    </div>
    <div class="oringinal-price">

    </div>
    <div class="final-price">
        {{ $book->finalPrice }}
    </div>
@else
    <div class="final-price">
        {{ $book->finalPrice }}
    </div>
@endif

<add-to-cart-btn-component
    id={{$book->id}}
></add-to-cart-btn-component>