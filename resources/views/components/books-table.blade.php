<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Title
                </th>
                <th>
                    Price
                </th>
                <th>
                   Stock quantity
                </th>
                <th>
                    Discount
                </th>
                <th>
                    Category
                </th>
                <th>
                    Status
                </th>
                <th>
                    Created by
                </th>
                <th>
                    Last modified by
                </th>
                <th>
                    Created at
                </th>
                <th>
                    Modified at
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>
                        {{ $book->id }}
                    </td>
                    <td>
                        <a href="{{ route('admin-books.show', ['book'=>$book]) }}" class="link">{{ $book->title }}</a>
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
                        <a href="/" class="link">{{ $book->category->name }}</a>
                    </td>
                    <td>
                        @if( $book->deleted_at) 
                            Unavailable
                        @else
                            Available
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin-users.show', ['user'=>$book->addedBy->id]) }}" class="link">{{ $book->addedBy->first_name . ' ' . $book->addedBy->name }}</a>
                    </td>
                    <td>
                        <a href="{{ route('admin-users.show', ['user'=>$book->updatedBy->id]) }}" class="link">{{ $book->updatedBy->first_name . ' ' . $book->updatedBy->name }}</a>
                    </td>
                    <td>
                        {{ $book->created_at }}
                    </td>
                    <td>
                        {{ $book->updated_at }}
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
</div>
{{ $books->links() }}