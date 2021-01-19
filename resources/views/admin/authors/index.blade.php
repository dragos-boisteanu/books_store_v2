@extends('layouts.app')

@section('content')

<div class="view">
    @include('includes.dashboard-nav')

    <div class="view__content">
        <h1>Authors List</h1>
        <div class="filter-container">
            <h2>Filter</h2>
            <form method="GET" action="{{ route('admin-authors.index')}}">
                <div class="filter">
                    <div class="form-group">
                        <div class="form-group">
                            <input type="number" name="id" class="form-input" placeholder="Author ID" value="{{ old('id') }}"/>
                        </div>
                        <div class="form-group">
                            <input type="number" name="created_by" class="form-input" placeholder="Created By ID" value="{{ old('created_by') }}"/>
                        </div>
                        <div class="form-group">
                            <input type="number" name="updated_by" class="form-input" placeholder="Updated By ID" value="{{ old('updated_by') }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <input type="text" name="first_name" class="form-input" placeholder="First name" value="{{ old('first_name') }}"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="form-input" placeholder="Name" value="{{ old('name') }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="created-at-after" class="form-label">Added after</label>
                            <input type="date" id="created-at-after" class="form-input" name="created_at_start" value="{{ old('created_at_start') }}">            
                        </div>
                        <div class="form-group">
                            <label for="created-at-before" class="form-label">Added before</label>
                            <input type="date" id="created-at-before" class="form-input" name="created_at_end" value="{{ old('created_at_end') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="updated-at-after" class="form-label">Updated after</label>
                            <input type="date" id="updated-at-after" class="form-input" name="updated_at_start" value="{{ old('updated_at_start') }}">            
                        </div>
                        <div class="form-group">
                            <label for="updated-at-before" class="form-label">Updated before</label>
                            <input type="date" id="updated-at-before" class="form-input" name="updated_at_end" value="{{ old('updated_at_end') }}">
                        </div>
                    </div>
                </div>   
                
                <div class="filter__actions">
                    <button type="submit" class="button button-primary">Filter</button>
                    <button id="reset-btn" class="button button-primary">Reset</button>
                </div>
            </form>
          
            <form method="GET" id="reset-form" action="{{ route('admin-authors.index')}}"></form>
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