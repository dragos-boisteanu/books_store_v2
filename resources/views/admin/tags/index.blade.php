@extends('layouts.app')

@section('content')

<div class="view">
    @include('includes.dashboard-nav')

        <div class="view__content">
            {{ Breadcrumbs::render('dashboard-tags.index') }}
            <h1>Tags List</h1>    
            <div class="filter-container">
                <h2>Filter</h2>
                <form method="GET" action="{{ route('admin-tags.index')}}">

                    <div class="filter">
                        <div class="form-group">
                            <div class="form-group">
                                <input type="number" class="form-input" name="id" placeholder="Tag ID" value="{{ old('id') }}"/>
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-input" name="name" placeholder="Tag name" value="{{ old('name') }}"/>
                            </div>
                        </div>
                        <div class="form-group">                        
                            <div class="form-group">
                                <input type="number" class="form-input" name="created_by" placeholder="Created by ID" value="{{ old('created_by') }}" />
                            </div>

                            <div class="form-group">
                                <input type="number" class="form-input" name="updated_by" placeholder="Updated by ID" value="{{ old('updated_by') }}" />
                            </div>
                        </div>
                    </div>

                    <div class="filter__actions">
                        <button type="submit" class="button button-primary">Filter</button>
                        <button id="reset-btn" class="button button-primary">Reset</button>
                    </div>
                </form>
            </div>            
            <div class="table-container">
                <h2>Tags</h2>
                <table>
                    <thead>
                        <tr>
                            <th>
                                ID
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>
                                    {{ $tag->id }}
                                </td>
                                <td>
                                    {{ $tag->name }}
                                </td>
                                <td>
                                    <a class="link" href="{{ route('admin-users.show', ['user'=>$tag->created_by]) }}">#{{ $tag->created_by }} </a>
                                </td>
                                <td>
                                    <a class="link" href="{{ route('admin-users.show', ['user'=>$tag->updated_by]) }}">#{{ $tag->updated_by }} </a>
                                </td>
                                <td>
                                    {{ $tag->created_at }}
                                </td>
                                <td>
                                    {{ $tag->updated_at }}
                                </td>
                                <td>
                                    <a class="link" href="{{ route('admin-tags.edit', ['tag'=>$tag->id]) }}"> Edit</a>
                                </td>
                                <td>
                                    <a class="link" href="{{ route('admin-tags.show', ['tag'=>$tag->id]) }}"> View</a>
                                </td>
                                <td>
                                    <a id="delete-btn" class="link">Delete</a>
                                    <form method="POST" id="delete-form" action="{{ route('admin-tags.destroy', ['tag'=>$tag->id])}}" style="display: none">
                                        @csrf
                                        @method('delete')
                                       
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $tags->links() }}
        </div>
</div>
    

@endsection


@push('vue-scripts')

    <script>
        const resetBtn = document.getElementById('reset-btn');
        const resetForm = document.getElementById('reset-form');
        const deleteBtn = document.getElementById('delete-btn');
        const deleteForm = document.getElementById('delete-form');

        deleteBtn.addEventListener('click', (event) => {
            event.preventDefault();

            deleteForm.submit();
        })

     

        resetBtn.addEventListener('click', (event) => {
            event.preventDefault();

            resetForm.submit();
        })
        
    </script>

@endpush