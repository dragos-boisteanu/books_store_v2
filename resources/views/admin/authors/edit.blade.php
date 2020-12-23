@extends('layouts.app')

@section('content')

    <div>
        <h1>
            Edit author  #{{ $author->id }}
        </h1>
        <form method="POST" action="{{ route('admin-authors.update', ['author'=>$author->id]) }}">
            @csrf
            @method('PUT')

            <div>
                <label for="first-name">First name</label>
                <input type="text" id="first-name" name="first_name" value="{{ $author->first_name}}"/>
            </div>

            <div>
                <label for="name">First name</label>
                <input type="text" id="name" name="name" value="{{ $author->name }}" />
            </div>

            <div>
                <button type="submit">Save</button>
            </div>

        </form>

    </div>
@endsection