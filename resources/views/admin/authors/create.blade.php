@extends('layouts.app')

@section('content')

    <div>
        <h1>
            Create author 
        </h1>
        <form method="POST" action="{{ route('admin-authors.store') }}">
            @csrf

            <div>
                <label for="first-name">First name</label>
                <input type="text" id="first-name" name="first_name" value="{{ old('first_name') }}"/>
            </div>

            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" />
            </div>

            <div>
                <button type="submit">Save</button>
            </div>

        </form>

    </div>
@endsection