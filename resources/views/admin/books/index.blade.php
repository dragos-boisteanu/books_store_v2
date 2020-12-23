@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <h1>Lista produse</h1>
        <div class="filter">
            <form method="POST" action="{{ route('admin-books.index')}}">
                @csrf

                <input type="text" name="title" placeholder="Book title"/>
                <input type="text" name="author" placeholder="Author name"/>
                
                <select name="stock">
                    <option value="0" disabled selected>Alege stocul</option>
                    <option value="1">Disponibil</option>
                    <option value="2">Indisponibil</option>
                </select>

                <select name="category">
                    <option value="0" disabled selected>Alege categoria</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <label for="created_at">Adaugat intre</label>
                <input type="date" id="created_at" name="created_at_start">
                <input type="date" name="created_at_end">

                <label for="updated_at">Modificat intre</label>
                <input type="date" id="updated_at" name="updated_at_start">
                <input type="date" name="updated_at_end">

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
                    Titlu
                </th>
                <th>
                    Pret
                </th>
                <th>
                    Cantitate disponibila in stoc
                </th>
                <th>
                    Discount
                </th>
                <th>
                    Categorie
                </th>
                <th>
                    Statut
                </th>
                <th>
                    Adaugata de
                </th>
                <th>
                    Ultima modificare de
                </th>
                <th>
                    Adaugata la
                </th>
                <th>
                    Modificata la
                </th>
            </tr>
            @foreach($books as $book)
                <tr>
                    <td>
                        {{ $loop->iteration  }} 
                    </td>
                    <td>
                        {{ $book->id }}
                    </td>
                    <td>
                        <a href="{{ route('admin-books.show', ['book'=>$book]) }}">{{ $book->title }}</a>
                    </td>
                    <td>
                        {{ $book->price }}
                    </td>
                    <td>
                        {{-- {{ $book->stocks->quantity }} --}}
                    </td>
                    <td>
                        {{ $book->discount }}
                    </td>
                    <td>
                        <a href="/">{{ $book->category->name }}</a>
                        
                    </td>
                    <td>
                        @if( $book->deleted_at) 
                            INDISPONIBILA
                        @else
                            DISPONIBILA
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin-users.show', ['user'=>$book->addedBy->id]) }}">{{ $book->addedBy->first_name . ' ' . $book->addedBy->name }}</a>
                    </td>
                    <td>
                        <a href="{{ route('admin-users.show', ['user'=>$book->updatedBy->id]) }}">{{ $book->updatedBy->first_name . ' ' . $book->updatedBy->name }}</a>
                    </td>
                    <td>
                        {{ $book->created_at }}
                    </td>
                    <td>
                        {{ $book->updated_at }}
                    </td>
                </tr>

            @endforeach

        </table>
            
        </ul>
        {{ $books->links() }}
    </div>

    
@endsection
