@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <h1>Lista utilizatori</h1>
        <div class="filter">
            <form method="POST" action="{{ route('admin-users.index')}}">
                @csrf
    
                <input type="text" name="first_name" placeholder="Prenume"/>
                <input type="text" name="name" placeholder="Nume"/>
                    
                <select name="role">
                    <option value="0" disabled selected>Alege rolul</option>
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>

                <label for="created_at">Inregistrat intre</label>
                <input type="date" id="created_at" name="created_at_start">
                <input type="date" name="created_at_end">
    
                <button type="submit">Aplica filtrul</button>
    
            </form>
        </div>
        <table>
            <tr>
                <th>
                    Index
                </th>
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
                <th>
                    Actions
                </th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <th>
                        {{ $loop->iteration  }}
                    </th>
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
                        {{ $user->created_at }}
                    </td>
                    <td>
                        <a href="{{ route('admin-users.show', ['user'=>$user->id]) }}">Detalii</a>
                        <form method="POST" action="{{ route('admin-users.destroy', ['user'=>$user->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $users->links() }}
       
    </div>
@endsection