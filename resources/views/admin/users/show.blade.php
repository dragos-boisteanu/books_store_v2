@extends('layouts.app')

@section('content')
    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            <div>
                <h1>Informatii utilizator</h1>
            </div>
            <div>
                <h2>Date cont</h2>
                <ul>
                    <li>
                        <span>ID: </span> <span>{{ $user->id }}</span>
                    </li>
                    <li>
                        <span>Rol:</span> <span>{{ $user->role->name }}</span>
                    </li>
                    <li>
                        <span>Prenume:</span> <span>{{ $user->first_name }}</span>
                    </li>
                    <li>
                        <span>Nume:</span> <span> {{ $user->name }}</span>
                    </li>
                    <li>
                        <span>E-mail: </span> <span> {{ $user->email }} </span>
                    </li>
                    <li>
                        <span>Phone Number:</span> <span> {{ $user->phone_number }} </span>
                    </li>
                </ul>
            </div>
            <div>
                <h2>Comenzi</h2>
                @if ( count($user->orders) > 0)
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        Index
                                    </th>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Deliver to
                                    </th>
                                    <th>
                                    Shipping Method
                                    </th>
                                    <th>
                                        Payment Method
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                    Total
                                    </th>
                                    <th>
                                        Created at
                                    </th>
                                    <th>
                                        Last modified at
                                    </th>
                                    <th>
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $user->orders as $order)
                                    <tr>
                                        <th>
                                            {{ $loop->iteration  }}
                                        </th>
                                        <td>
                                        {{ $order->id }}
                                        </td>
                                        <td>
                                            {{ $order->shipping_address->first_name . ' ' . $order->shipping_address->name }}
                                        </td>
                                        <td>
                                            {{ $order->shipping_method->name }} 
                                        </td>
                                        <td>
                                            {{ $order->payment_method->name }}
                                        </td>
                                        <td>
                                            {{ $order->status->name }}
                                        </td>
                                        <td>
                                            {{ $order->total_price }}
                                        </td>
                                        <td>
                                            {{ $order->created_at }}
                                        </td>
                                        <td>
                                            {{ $order->updated_at }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin-orders.show', ['order'=>$order->id]) }}" >Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else  
                    <div>
                        No orders for this user
                    </div>
                @endif
            </div>
            
            @if ($user->role_id == 2 || $user->role_id == 3)
                @if (isset($addedBooks))
                <div>
                    <h2>Produse adaugate</h2>
                    <div class="table-container">
                        <table>
                            <thead>
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
                                        Adaugat la
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $addedBooks as $addedBook)
                                    <tr>
                                        <th>
                                            {{ $loop->iteration  }}
                                        </th>
                                        <td>
                                            {{ $addedBook->id }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin-books.show', ['book'=>$addedBook->id]) }}">{{ $addedBook->title }}</span></a>
                                        </td>
                                        <td>
                                            {{ $addedBook->created_at }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                        
                        </table>
                    </div>
                    
                    {{ $addedBooks->links() }}
                </div>

            @else
                <div>
                    No product added by this user
                </div>
            @endif
            
            @if( isset($updatedBooks))
                <div>
                    <h2>Produse modificare</h2>
                    <div class="table-container">
                        <table>
                            <thead>
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
                                        Modificata la
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $updatedBooks as $updatedBook)
                                    <tr>
                                        <th>
                                            {{ $loop->iteration  }}
                                        </th>
                                        <td>
                                            {{ $updatedBook->id }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin-books.show', ['book'=>$updatedBook->id]) }}">{{ $updatedBook->title }}</span></a>
                                        </td>
                                        <td>
                                            {{ $updatedBook->created_at }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $addedBooks->links() }}
                </div>    
            @else 
                <div>
                    No items updated by this user
                </div>
            @endif
            @endif
            
            
        </div>
        
    </div>  
@endsection 