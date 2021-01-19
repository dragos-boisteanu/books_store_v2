@extends('layouts.app')

@section('content')

<div class="view">
    @include('includes.dashboard-nav')

    <div class="view__content">
        <div>
            <h1>Authors List</h1>
        </div>
    
        <div class="filter">
            <form method="GET" action="{{ route('admin-authors.index')}}">
    
                <input type="number" name="id" placeholder="Order ID" value="{{ old('id') }}"/>
                <input type="text" name="first_name" placeholder="First name" value="{{ old('first_name') }}"/>
                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" />
    
                <input type="number" name="created_by" placeholder="Created By ID" value="{{ old('created_by') }}"/>
                <input type="number" name="updated_by" placeholder="Updated By ID" value="{{ old('updated_by') }}"/>
    
                <label for="created-at-after">Added after</label>
                <input type="date" id="created-at-after" name="created_at_start" value="{{ old('created_at_start') }}">
    
                <label for="created-at-before">Added before</label>
                <input type="date" id="created-at-before" name="created_at_end" value="{{ old('created_at_end') }}">
    
                <label for="updated-at-after">Updated after</label>
                <input type="date" id="updated-at-after" name="updated_at_start" value="{{ old('updated_at_start') }}">
    
                <label for="updated-at-before">Updated before</label>
                <input type="date" id="updated-at-before" name="updated_at_end" value="{{ old('updated_at_end') }}">
    
                <button type="submit">Filter</button>
    
            </form>
    
            
            <form method="GET" action="{{ route('admin-authors.index')}}">
                <button>Clear</button>
            </form>
        </div>
    
    
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>
                            Index
                        </th>
                        <th>
                            First name
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Created By
                        </th>
                        <th>
                            Updated By
                        </th>
                        <th>
                            Created At
                        </th>
                        <th>
                            Updated At
                        </th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <td>
                                {{ $loop->iteration }} 
                            </td>
                            <td>
                                {{ $author->first_name }}
                            </td>
                            <td>
                                {{ $author->name }}
                            </td>
                            <td>
                                <a class="link" href="{{ route('admin-users.show', ['user'=>$author->created_by]) }}">#{{ $author->created_by }} </a>
                            </td>
                            <td>
                                <a class="link" href="{{ route('admin-users.show', ['user'=>$author->updated_by]) }}">#{{ $author->updated_by }} </a>
                            </td>
                            <td>
                                {{ $author->created_at }}
                            </td>
                            <td>
                                {{ $author->updated_at }}
                            </td>
                            <td>
                                <a class="link" href="{{ route('admin-authors.edit', ['author'=>$author->id]) }}"> Edit</a>
                            </td>
                            <td>
                                <a class="link" href="{{ route('admin-authors.show', ['author'=>$author->id]) }}"> View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $authors->links() }}
    </div>
</div>
    

@endsection