@extends('layouts.app')

@section('content')
    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            <h1>Books list</h1>
            <div class="filter-container">
                <h2>Filter</h2>
                <form method="GET" action="{{ route('admin-books.index')}}">

                    <div class="filter">
                        <div class="form-group">
                            <div class="form-group">
                                <input type="text" name="title" class="form-input" placeholder="Book title" value="{{ old('title')}}"/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="author_first_name" class="form-input" placeholder="Author first name" value="{{ old('author_first_name')}}" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="author_name" class="form-input" placeholder="Author name" value="{{ old('author_name')}}"/>
                            </div>
                            <div class="form-group">
                                <input type="number" name="created_by" class="form-input" placeholder="Created by ID" value="{{ old('created_by')}}"/>
                            </div>
                            <div class="form-group">
                                <input type="number" name="updated_by" class="form-input" placeholder="UUpdated by ID" value="{{ old('updated_by')}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <select name="stock" class="form-input">
                                    <option value="0" disabled selected>Stock</option>
                                    <option value="1">Unavailable</option>
                                    <option value="2">Available</option>
                                </select>
                            </div>
                            
        
                            <div class="form-group">
                                <select name="category" class="form-input">
                                    <option value="0" disabled selected>Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="created-at-after" class="form-label">Added after</label>
                                <input type="date" id="created-at-after" name="created_at_start" class="form-input" value="{{ old('created_at_start') }}">
                            </div>
                            <div class="form-group">
                                <label for="created-at-before" class="form-label">Added before</label>
                                <input type="date" id="created-at-before" name="created_at_end" class="form-input" value="{{ old('created_at_end') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="updated-at-after" class="form-label">Updated after</label>
                                <input type="date" id="updated-at-after" name="updated_at_start" class="form-input" value="{{ old('updated_at_start') }}">
                            </div>
                            <div class="form-group">
                                <label for="updated-at-before" class="form-label">Updated before</label>
                                <input type="date" id="updated-at-before" name="updated_at_end" class="form-input" value="{{ old('updated_at_end') }}">
                            </div>
                        </div>
                    </div>

                    <div class="filter__actions">
                        <button type="submit" class="button button-primary">Filter</button>
                        <button id="reset-btn" class="button button-primary">Reset</button>
                    </div>
                   
                </form>

                <form method="GET" id="reset-form" action="{{ route('admin-books.index')}}" style="display: none"></form>
            </div>

            <h2>Books</h2>
            <x-books-table
                :books="$books"
            ></x-books-table>
        </div>
    </div>
@endsection


@push('vue-scripts')

    <script>
        const resetBtn = document.getElementById('reset-btn');
        const resetForm = document.getElementById('reset-form');

        resetBtn.addEventListener('click', (event) => {
            event.preventDefault();

            resetForm.submit();
        })
    </script>

@endpush