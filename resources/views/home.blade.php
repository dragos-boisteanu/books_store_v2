@extends('layouts.app')

@section('content')
<div id="view" class="container">
    <div class="carrousel">
      test
    </div>
    <demo-component></demo-component>
    <ul class="list books">
        @foreach ($books as $book)
            <li class="book">
                <div class="book_title">
                    {{ $book->title }}
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
              
            </li>
        @endforeach
    </ul>
    {{ $books->links() }}
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
