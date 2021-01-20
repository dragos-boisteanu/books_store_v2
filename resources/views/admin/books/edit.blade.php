@extends('layouts.app')

@section('content')
    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            <form id="edit-book" method="POST" action="{{ route('admin-books.update', ['book'=>$book->id]) }}">
                @csrf
                @method('PUT')
    
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-input" value="{{ $book->title }}"/>
                </div>

                <div class="form-group">
                    <label for="image-link" class="form-label">Image URL</label>
                    <input type="text" id="image-link" name="image_link" class="form-input" value="{{ $book->image_link }}"/>
                </div>

                <div class="form-group">
                    <label class="form-label">ISBN</label>
                    <input type="text" name="isbn" class="form-input" value="{{ $book->isbn }}"/>
                </div>

                <div class="form-group">
                    <label class="form-label">Pages</label></label>
                    <input type="text" name="pages" class="form-input" value="{{ $book->pages }}"/>
                </div>

                <div class="form-group">
                    <label class="form-label">Price</label>
                    <input type="text" name="price" class="form-input" value="{{ $book->price }}"/>
                </div>

                <div class="form-group">
                    <label class="form-label">Discount</label>
                    <input type="text" name="discount" class="form-input" value="{{ $book->discount }}"/>
                </div>

                <div class="form-group"> 
                    <label class="form-label">Authors</label>
                    <dynamic-input-component route="authors" wordsprop="{{ $book->authors }}" v-on:updated="updateAuthors"></dynamic-input-component>
                    <input type="hidden" name="authors" class="form-input" v-model="authors"/>
                </div>

                <div class="form-group">
                    <label class="form-label">Published date</label>
                    <input type="date" name="published_at" class="form-input" value="{{ $book->published_at }}" />
                </div>

                <div class="form-group">
                    <label class="form-label">Publisher</label>
                    <select name="publisher_id" class="form-input">
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}" {{ $book->publisher_id == $publisher->id ? 'selected' : '' }}>{{$publisher->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Language</label>
                    <select name="language_id" class="form-input">
                        @foreach($languages as $language)
                            <option value="{{ $language->id }}" {{ $book->language_id == $language->id ? 'selected' : '' }}>{{$language->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-input">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Cover type</label>
                    <select name="cover_id" class="form-input">
                        @foreach($covers as $cover)
                            <option value="{{ $cover->id }}" {{ $book->cover_id == $cover->id ? 'selected' : '' }}>{{$cover->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" placeholder="Descriere">{{ $book->description }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-input" value="{{ $book->stock->quantity }}"/>
                </div>

                <div class="form-group">
                    <label class="form-label">Tags</label>
                    <dynamic-input-component wordsprop="{{ $book->tags }}" route="tags" v-on:updated="updateTags"></dynamic-input-component>
                    <input type="hidden" name="tags" class="form-input" v-model="tags"/>
                </div>

                <div class="form-action">
                    <a href="{{ route('admin-books.index') }}" class="link">Back</a>
                    <button type="submit" class="button button-primary">Save</button>
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