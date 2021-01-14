@extends('layouts.app')

@section('content')
    <div id="form" class="dashboard">
        <h1>Add a book</h1>
        <form method="POST" novalidate action="{{ route('admin-books.store') }}">
            @csrf
            <div>
                <label>Titlu</label>
                <div v-if="showErrors">
                    @{{ getError('title')}}

                </div>
                <input type="text" name="title" v-model.trim="book.title" rules="required"/>

            </div>
            <div>
                <label for="isbn">ISBN</label>
                <div v-if="showErrors">
                    @{{ getError('isbn')}}

                </div>
                <input type="number" id="isbn" name="isbn" v-model.trim="book.isbn" value="{{ old('isbn') }}"/>
            </div>
            <div>
                <label for="pages">Pages count</label>
                <input type="number" id="pages" name="pages" value="{{ old('pages') }}"/>
            </div>
            <div>
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}"/>
            </div>
            <div>
                <label for="price">Price</label>
                <input type="nmber" id="price" name="price" value="{{ old('price') }}" />
            </div>
            <div>
                <label for="discount">Discount</label>
                <input type="number" id="discount" name="discount" value="{{ old('discount') }}"/>
            </div>
            <div>
                <label>Authors</label>
                <dynamic-input-component route="authors" v-on:updated="updateAuthors"></dynamic-input-component>
                <input type="hidden" name="authors" v-model="book.authors"/>
            </div>
            <div>
                <label for="published-at">Data publicarii</label>
                <input type="date" id="published-at" name="published_at" value="{{ old('published_at') }}"/>
            </div>
            <div>
                <label>Publisher</label>
                <select name="publisher_id">
                    @foreach($publishers as $publisher)
                        <option value="{{ $publisher->id }}" {{ $publisher->id === old('publisher_id') ? 'selected' : '' }} >{{$publisher->name}}</option>
                    @endforeach
                </select>    
            </div>
            <div>
                <label>Language</label>
                <select name="language_id">
                    @foreach($languages as $language)
                        <option value="{{ $language->id }}" {{ $language->id === old('language_id') ? 'selected' : '' }}>{{$language->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Category</label>
                <select name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Cover type</label>
                <select name="cover_id">
                    @foreach($covers as $cover)
                        <option value="{{ $cover->id }}" {{ $cover->id === old('cover_id') ? 'selected' : '' }}>{{$category->name}} >{{$cover->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Descriere</label>
                <textarea name="description" placeholder="Book description" value="{{ old('description') }}"></textarea>
            </div>
            <div>
                <label>Tags</label>
                <dynamic-input-component route="tags" v-on:updated="updateTags"></dynamic-input-component>
                <input type="hidden" name="tags" v-model="book.tags"/>
            </div>
            <div>
                <button v-on:click="checkForm">Add</button>
            </div>
        </form>
    </div>
@endsection

@push('vue-scripts')
    <script>
        const vue = new Vue({
            el: '#form',
            data: {
                book: {
                    title: '',
                    isbn: '',
                    pages: '',
                    price: 0,
                    discount: 0,
                    authors: '',
                    published_at: '',
                    publisher_id: '',
                    language_id: '',
                    cover_id: '',
                    description: '',
                    quantity: '',
                    tags: ''
                },
                errors: [],
            },
            created() {
                console.log('vue instance from craeting author');
            },   
            computed: {
                showErrors() {
                    if(this.errors.length > 0){
                        return true;
                    }else {
                        return false;
                    }
                }
            },
            methods: {
                getError(input) {
                    let error = this.errors[this.errors.findIndex(error => error.input == input)];
                    if(error) {
                        return error.message;
                    }
                    
                },
                updateAuthors(value) {
                    this.authors = JSON.stringify(value)
                },
                updateTags(value) {
                    this.tags = JSON.stringify(value);
                },
                checkForm( event ) {  
                    this.errors = [];

                    if (!this.book.title) {
                        this.errors.push({
                            input: 'title',
                            message: "Title trebuie completat."
                        });
                    }

                    let isbnRegex = new RegExp("^(?:ISBN(?:-1[03])?:? )?(?=[0-9X]{10}$|(?=(?:[0-9]+[- ]){3})[- 0-9X]{13}$|97[89][0-9]{10}$|(?=(?:[0-9]+[- ]){4})[- 0-9]{17}$)(?:97[89][- ]?)?[0-9]{1,5}[- ]?[0-9]+[- ]?[0-9]+[- ]?[0-9X]$");

                    if (!this.book.isbn) {
                        this.errors.push({
                            input: 'isbn',
                            message: "ISBN trebuie completat."
                        });
                    }else if (isbnRegex.test(this.book.isbn)) {
                        console.log('lenght')
                        this.errors.push({
                            input: 'isbn',
                            message: "ISBN nu este valid"
                        });
                    }


                    if (!this.book.pages) {
                        this.errors.push({
                            input: 'pages',
                            message: "Pages required."
                        });
                    }


                    if (!this.book.price) {
                        this.errors.push({
                            input: 'price',
                            message: "Price required."
                        });
                    }



                    if (!this.errors.length) {
                        return true;
                    }
                    else{
                        console.log(this.errors)
                    }

                    event.preventDefault();
                }
            }       
        });
    </script>
@endpush