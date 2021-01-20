@extends('layouts.app')

@section('content')
    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            {{ Breadcrumbs::render('dashboard-tags.create') }}
            <h1>
                Create tag 
            </h1>
            <form method="POST" action="{{ route('admin-tags.store') }}">
                @csrf
    
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}"/>
                </div>
        
                <div>
                    <button type="submit" class="button button-primary">Save</button>
                </div>
    
            </form>
    
        </div>
    </div>
    
@endsection