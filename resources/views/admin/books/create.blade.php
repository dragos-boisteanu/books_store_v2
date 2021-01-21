@extends('layouts.app')

@section('content')
    <div id="form" class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            {{ Breadcrumbs::render('dashboard-book.create') }}
            <h1>Add a book</h1>
            <form method="POST" novalidate action="{{ route('admin-books.store') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-input"/>
                </div>

                <div class="form-group">
                    <label for="image-link" class="form-label">Image URL</label>
                    <input type="text" id="image-link" name="image_link" class="form-input" value="{{ old('image_link') }}"/>
                </div>

                <div class="form-group">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" id="isbn" name="isbn" class="form-input" value="{{ old('isbn') }}"/>
                </div>

                <div class="form-group">
                    <label for="pages" class="form-label">Pages count</label>
                    <input type="text" id="pages" name="pages" class="form-input" value="{{ old('pages') }}"/>
                </div>

                <div class="form-group">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="text" id="quantity" name="quantity" class="form-input" value="{{ old('quantity') }}"/>
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" id="price" name="price" class="form-input" value="{{ old('price') }}" />
                </div>

                <div class="form-group">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="text" id="discount" name="discount" class="form-input" value="{{ old('discount') }}"/>
                </div>

                <div class="form-group">
                    <label class="form-label">Authors</label>
                    <dynamic-input-component route="authors" v-on:updated="updateAuthors"></dynamic-input-component>
                    <input type="hidden" name="authors" v-model="authors"/>
                </div>

                <div class="form-group">
                    <label for="published-at" class="form-label">Data publicarii</label>
                    <input type="date" id="published-at" name="published_at" class="form-input" value="{{ old('published_at') }}"/>
                </div>

                <div class="form-group">
                    <label class="form-label">Publisher</label>
                    <select name="publisher_id" class="form-input">
                        <option value="0" selected disabled>Choose publisher</option>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}" {{ $publisher->id === old('publisher_id') ? 'selected' : '' }} >{{$publisher->name}}</option>
                        @endforeach
                    </select>    
                </div>

                <div class="form-group">
                    <label class="form-label">Language</label>
                    <select name="language_id" class="form-input">
                        <option value="0" selected disabled>Choose language</option>
                        @foreach($languages as $language)
                            <option value="{{ $language->id }}" {{ $language->id === old('language_id') ? 'selected' : '' }}>{{$language->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-input">
                        <option value="0" selected disabled>Choose category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Cover type</label>
                    <select name="cover_id" class="form-input">
                        <option value="0" selected disabled>Choose cover type</option>
                        @foreach($covers as $cover)
                            <option value="{{ $cover->id }}" {{ $cover->id === old('cover_id') ? 'selected' : '' }}>{{$cover->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Descriere</label>
                    <textarea name="description" placeholder="Book description" class="form-input" value="{{ old('description') }}"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Tags</label>
                    <dynamic-input-component route="tags" v-on:updated="updateTags"></dynamic-input-component>
                    <input type="hidden" name="tags" v-model="tags"/>
                </div>

                <div>
                    <button type="submit" class="button button-primary">Add</button>
                </div>
            </form>
        </div>
        
    </div>
@endsection

@push('vue-scripts')
    <script>
        const vue = new Vue({
            el: '#form',
            data: {
                authors: [],
                tags: []
            },
            
            methods: {
            
                updateAuthors(value) {
                    this.authors = JSON.stringify(value)
                },

                updateTags(value) {
                    this.tags = JSON.stringify(value);
                },
            
            }      
        });
    </script>
@endpush