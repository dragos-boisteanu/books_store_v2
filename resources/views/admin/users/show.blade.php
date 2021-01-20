@extends('layouts.app')

@section('content')
    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            {{ Breadcrumbs::render('dashboard-users.show', $user) }}
            
            <h1>User #{{ $user->id }}</h1>
         
            <div>
                <h2>Account data</h2>
                <ul class="details">
                    <li class="detail">
                        <span class="name">ID: </span> <span class="value">{{ $user->id }}</span>
                    </li>
                    <li class="detail">
                        <span class="name">Role:</span> <span class="value">{{ $user->role->name }}</span>
                    </li>
                    <li class="detail">
                        <span class="name">First name:</span> <span class="value">{{ $user->first_name }}</span>
                    </li>
                    <li class="detail">
                        <span class="name">Name:</span> <span class="value"> {{ $user->name }}</span>
                    </li>
                    <li class="detail">
                        <span class="name">E-mail: </span> <span class="value"> {{ $user->email }} </span>
                    </li>
                    <li class="detail">
                        <span class="name">Phone Number:</span> <span class="value"> {{ $user->phone_number }} </span>
                    </li>
                </ul>
            </div>
            <div>
                <h2>User's orders</h2>
                @if ( isset($user->orders) && $user->orders->isNotEmpty())
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $user->orders as $order)
                                    <tr>
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
                                            <a class="link" href="{{ route('admin-orders.show', ['order'=>$order->id]) }}" >Details</a>
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
                    <h2>Added books</h2>
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
                                        Created at
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $addedBooks as $addedBook)
                                    <tr>
                                        <td>
                                            {{ $addedBook->id }}
                                        </td>
                                        <td>
                                            <a class="link" href="{{ route('admin-books.show', ['book'=>$addedBook->id]) }}">{{ $addedBook->title }}</span></a>
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
                    <h2>Updated items</h2>
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
                                        Updated at
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $updatedBooks as $updatedBook)
                                    <tr>
                                        <td>
                                            {{ $updatedBook->id }}
                                        </td>
                                        <td>
                                            <a class="link" href="{{ route('admin-books.show', ['book'=>$updatedBook->id]) }}">{{ $updatedBook->title }}</span></a>
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