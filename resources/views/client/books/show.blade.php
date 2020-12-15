@extends('layouts.app')

@section('content')
    <div id="book">
        <div class="title">
            <h1>{{ $book->title }}</h1>
        </div>  
        <div class="">
            <div>
                IMG
            </div>
            <div>
                @if ( $book->discount > 0)
                    <div>
                        {{ $book->price }}
                        <div>
                            {{$book->discount}}%
                        </div>
                    </div>
                    <div>
                        {{ $book->FinalPrice }}
                    </div>
                @else 
                <div>
                    {{ $book->price }}
                </div>
                @endif
                <div>
                    @if ($book->stock->quantity < 1)
                        <div>
                            Produsul nu este disponobil
                        </div>
                    @else
                        <div>
                            Produsul este in stoc
                        </div>
                        <div>
                            <add-to-cart-btn-component
                                id={{$book->id}}
                            ></add-to-cart-btn-component>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="">
            <div>
                <div v-on:click="toggleTabs">
                    Descriere
                </div>
                <div v-on:click="toggleTabs">
                    Comentarii
                </div>
            </div>
            <div v-if="showDescription">
                {{ $book->description }}
            </div>
            <div v-else>
                comments
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