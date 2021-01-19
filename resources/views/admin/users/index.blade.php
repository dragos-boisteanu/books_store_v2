@extends('layouts.app')

@section('content')
    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            <h1>Users list</h1>
          
            <div class="filter-container">
                <h2>Filter</h2>
                <form method="POST" action="{{ route('admin-users.index')}}">
                    @csrf
        
                    <div class="filter">
                        <div class="col col-1">
                            <div class="form-group">
                                <input type="text" name="first_name" class="form-input" placeholder="Prenume"/>
        
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" class="form-input" placeholder="Nume"/>
                            </div>
                            <div class="form-group">
                                <select name="role" class="form-input">
                                    <option value="0" disabled selected>Alege rolul</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col col-2">
                            <div class="form-group">
                                <label for="created_at" class="form-label">Registered between</label>
                                <input type="date" id="created_at" name="created_at_start" class="form-input">
                            </div>
                            <div class="form-group">
                                <input type="date" name="created_at_end" class="form-input">
                            </div>
                        </div>
                    </div>
                        
                    <div class="filter__actions">
                        <button type="submit" class="button button-primary">Filter</button>
                        <button id="reset-btn" class="button button-primary">Reset</button>
                    </div>
                </form>

                <form method="GET" id="reset-form" action="{{ route('admin-users.index')}}" style="display: none"></form>
            </div>
                
            <div class="table-container">
                <h2>Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Prenume
                            </th>
                            <th>
                                Nume
                            </th>
                            <th>
                                Numar telefon
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Role
                            </th>
                            <th>
                                Inregistrat la
                            </th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $user->id }}
                                </td>
                                <td>
                                    {{ $user->first_name }}
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->phone_number }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->role->name }}
                                </td>
                                <td>
                                    {{ $user->created_at}}
                                </td>
                                <td>
                                    <a class="link" href="{{ route('admin-users.show', ['user'=>$user->id]) }}">Detalii</a>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('admin-users.destroy', ['user'=>$user->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>
@endsection


@push('vue-scripts')

    <script>
        const clearBtn = document.getElementById('reset-btn');
        const clearForm = document.getElementById('reset-form');

        clearBtn.addEventListener('click', (event) => {
            event.preventDefault();

            clearForm.submit();
        })
    </script>

@endpush