@extends('layouts.app')

@section('content')

    <div>
        <h1>Authors List</h1>
    </div>

    <table>
        <tr>
            <th>
                Index
            </th>
            <th>
                Name
            </th>
            <th>
                First name
            </th>
            <th>
                Created By
            </th>
            <th>
                Updated By
            </th>
            <th>
                Created By
            </th>
            <th>
                Updated By
            </th>
        </tr>
        @foreach($authors as $author)
            <tr>
                <td>
                    {{ $loop->iteration }} 
                </td>
                <td>
                    {{ $author->name }}
                </td>
                <td>
                    {{ $author->first_name }}
                </td>
                <td>
                    <a href="{{ route('admin-users.show', ['user'=>$author->created_by]) }}">{{ $author->created_by }} </a>
                </td>
                <td>
                    <a href="{{ route('admin-users.show', ['user'=>$author->updated_by]) }}">{{ $author->updated_by }} </a>
                </td>
                <td>
                    {{ $author->created_at }}
                </td>
                <td>
                    {{ $author->updated_at }}
                </td>
                <td>
                    <a href="{{ route('admin-authors.edit', ['author'=>$author->id]) }}"> Edit</a>
                </td>
                <td>
                    <a href="{{ route('admin-authors.show', ['author'=>$author->id]) }}"> View</a>
                </td>
            </tr>
        @endforeach
    </table>
    
    {{ $authors->links() }}

@endsection