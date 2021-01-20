@extends('layouts.app')

@section('content')

<div class="view">
    @include('includes.dashboard-nav')

        <div class="view__content">
            <h1>Tags List</h1>                
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>
                                Index
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
                        @foreach($tags as $tag)
                            <tr>
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
        const deleteBtn = document.getElementById('delete-btn');
        const deleteForm = document.getElementById('delete-form');

        deleteBtn.addEventListener('click', (event) => {
            event.preventDefault();

            deleteForm.submit();
        })


        
    </script>

@endpush