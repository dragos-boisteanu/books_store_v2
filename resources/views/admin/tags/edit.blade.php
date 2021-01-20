@extends('layouts.app')

@section('content')
    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            {{ Breadcrumbs::render('dashboard-tags.edit', $tag) }}
            <h1>
                Create tag 
            </h1>
            <form method="POST" action="{{ route('admin-tags.update', ['tag'=>$tag->id]) }}">
                @csrf
                @method('put')
    
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ $tag->name }}"/>
                </div>
        
                <div>
                    <button type="submit" class="button button-primary">Save</button>
                </div>
    
            </form>
    
        </div>
    </div>
    
@endsection