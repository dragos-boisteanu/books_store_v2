@extends('layouts.app')

@section('content')
    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            <form id="edit-book" method="POST" action="{{ route('admin-books.update', ['book'=>$book->id]) }}">
                @csrf
                @method('PUT')
    
                <div>
                    <label>Titlu</label>
                    <input type="text" name="title" value="{{ $book->title }}"/>
                </div>
                <div>
                    <label>ISBN</label>
                    <input type="text" name="isbn" value="{{ $book->isbn }}"/>
                </div>
                <div>
                    <label>Nr. Pagini</label>
                    <input type="text" name="pages" value="{{ $book->pages }}"/>
                </div>
                <div>
                    <label>Pret</label>
                    <input type="text" name="price" value="{{ $book->price }}"/>
                </div>
                <div>
                    <label>Reducere</label>
                    <input type="text" name="discount" value="{{ $book->discount }}"/>
                </div>
                <div>
                    <label>Autor/i</label>
                    <dynamic-input-component route="authors" wordsprop="{{ $book->authors }}" v-on:updated="updateAuthors"></dynamic-input-component>
                    <input type="hidden" name="authors" v-model="authors"/>
                </div>
                <div>
                    <label>Data publicarii</label>
                    <input type="date" name="published_at" value="{{ $book->published_at }}" />
                </div>
                <div>
                    <label>Editura</label>
                    <select name="publisher_id">
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}" {{ $book->publisher_id == $publisher->id ? 'selected' : '' }}>{{$publisher->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Limba</label>
                    <select name="language_id">
                        @foreach($languages as $language)
                            <option value="{{ $language->id }}" {{ $book->language_id == $language->id ? 'selected' : '' }}>{{$language->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Categorie</label>
                    <select name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Tipul copertii</label>
                    <select name="cover_id">
                        @foreach($covers as $cover)
                            <option value="{{ $cover->id }}" {{ $book->cover_id == $cover->id ? 'selected' : '' }}>{{$cover->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Descriere</label>
                    <textarea name="description" placeholder="Descriere">{{ $book->description }}</textarea>
                </div>
                <div>
                    <label>Cantitate</label>
                    <input type="number" name="quantity" value="{{ $book->stock->quantity }}"/>
                </div>
                <div>
                    <label>Tags</label>
                    <dynamic-input-component wordsprop="{{ $book->tags }}" route="tags" v-on:updated="updateTags"></dynamic-input-component>
                    <input type="hidden" name="tags" v-model="tags"/>
                </div>
                <div>
                    <button type="submit">Salveaza</button>
                    <a href="{{ route('admin-books.index') }}">Inapoi</a>
                </div>
            </form>
        </div>
        
    </div>
@endsection


@push('vue-scripts')
    <script>
        const vue = new Vue({
            el: '#edit-book',
            data(){
                return {
                    authors: '',
                    tags: ''
                  
                }
            },
            created() {
                console.log('vue instance from craeting author');
            },     
            methods: {
                updateAuthors(value) {
                    this.authors = JSON.stringify(value)
                },
                updateTags(value) {
                    this.tags = JSON.stringify(value);
                }
            }       
        });
    </script>
@endpush