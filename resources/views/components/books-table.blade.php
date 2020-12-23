<div>
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
                    {{ $book->stock->quantity }}
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
    
    {{ $books->links() }}
</div>