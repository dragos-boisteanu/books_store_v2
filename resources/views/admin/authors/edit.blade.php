@extends('layouts.app')

@section('content')
<div class="view">
    @include('includes.dashboard-nav')
    <div class="view__content">
        {{ Breadcrumbs::render('dashboard-authors.edit', $author) }}
        <h1>
            Edit author  #{{ $author->id }}
        </h1>
        <form method="POST" action="{{ route('admin-authors.update', ['author'=>$author->id]) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first-name" class="form-label">First name</label>
                <input type="text" id="first-name" name="first_name" class="form-input" value="{{ $author->first_name}}"/>
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ $author->name }}" />
            </div>

            <div>
                <button type="submit" class="button button-primary">Save</button>
            </div>

        </form>
    </div>
</div>

@endsection