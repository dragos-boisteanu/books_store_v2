@extends('layouts.app')

@section('content')
    <div id="book" class="view">
        <div class="view__content book">
            <div class="book__header">
                <div class="header__image">
                    <img src="https://cdn.dc5.ro/img-prod/9781405918992-2750310-240.jpg"/>
                </div>
                
                <div class="header__details">
                    <h1>{{ $book->title }}</h1>
                    <ul class="list list-horizontal authors__list">
                        @foreach( $book->authors as $author)
                            <li class="author">
                                <a class="link" href="{{ route('authors-books.show', ['id'=>$author->id])}}">{{ $author->first_name }} {{ $author->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="price">
                        @if ( $book->discount > 0)
                            <div class="price__discount">
                                <div class="discount__original-price">
                                    {{ $book->price }} RON
                                </div>
                                <div class="discount__amount">
                                    {{$book->discount}} %
                                </div>
                            </div>
                        @endif
                        <div class="price__final">
                            {{ $book->price }} RON
                        </div>
                    </div>
                    <div class="stock">
                        @if ($book->stock->quantity < 1)
                            <div class="stock__status stock__empty">
                                Not in stock
                            </div>
                        @else
                            <div class="stock__status stock__exists">
                                In stock
                            </div>
                        @endif
                    </div>
                    <div class="details">
                        <div class="detail">
                            <div class="text">
                                ISBN:
                            </div>
                            <div class="value">
                                {{ $book->isbn }}
                            </div>
                        </div>
                        <div class="detail">
                            <div class="text">
                                Publisher:
                            </div>
                            <div class="value publisher">
                                {{ $book->publisher->name }}
                            </div>
                        </div>
                        <div class="detail">
                            <div class="text">
                                Pages:
                            </div>
                            <div class="value">
                                {{ $book->pages }}
                            </div>
                        </div>
                        <div class="detail">
                            <div class="text">
                                Cover:
                            </div>
                            <div class="value">
                                {{ $book->cover->name }}
                            </div>
                        </div>
                        <div class="detail">
                            <div class="text">
                                Category:
                            </div>
                            <div class="value publisher">
                                <a class="link" href="{{ route('category-books.show', ['id'=>$book->category_id])}}">{{ $book->category->name }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="header__action">
                        @if ($book->stock->quantity >= 1)
                            <add-to-cart-btn-component
                                id={{$book->id}}
                            ></add-to-cart-btn-component>
                        @else 
                            <div class="action__filler">

                            </div>
                        @endif
                    </div>  
                </div>
            </div>
            <div class="book__body">
                <div class="body__tab-bar">
                    <div v-on:click="toggleTabs" class="tab-bar__tab" :class="{'tab-bar__tab--selected': showDescription}">
                        Descriere
                    </div>
                    <div v-on:click="toggleTabs" class="tab-bar__tab" :class="{'tab-bar__tab--selected': !showDescription}">
                        Comentarii
                    </div>
                </div>
                <div v-if="showDescription" class="descrption">
                    {{ $book->description }}
                </div>
                <div v-else>
                    comments
                </div>
            </div>
        </div>
    </div>
@endsection 

@push('vue-scripts')
    <script>
        new Vue({
            el: '#book',

            data: {
                showDescription: true,
            },

            created() {
                console.log('vue instance from craeting home');
            },  

            methods: {
                toggleTabs() {
                    this.showDescription = !this.showDescription;
                }
            }  
        });
    </script>
@endpush