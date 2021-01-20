@extends('layouts.app')

@section('content')

    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            <h1 class="view__header">
                Order {{ $order->id }} # - {{ $order->status->name }} - @if($order->deleted_at) DISABLED @endif
            </h1>
            <ul class="details">
                <li class="detail">
                    <span class="name">Operator: </span> 
                    <span class="value"> <a class="link" href="{{ route('admin-users.show', ['user'=>$order->operator->id]) }}">{{ $order->operator->first_name , ' ' . $order->operator->name }}</a></span>
                </li>
                <li class="detail">
                    <span class="name">Created on:</span>
                    <span class="value">{{ $order->created_at }}</span>
                </li>
                <li class="detail">
                    <span class="name">Payment method:</span>
                    <span class="value">{{ $order->payment_method->name }} </span>
                </li>
                <li class="detail">
                    <span class="name">Delivery method:</span>
                    <span class="value">{{ $order->shipping_method->name }}</span>
                </li>
                <li class="detail">
                    <span class="name">Shipping address:</span>
                    <span class="value">
                        <x-address
                            :address="$order->shipping_address"
                        />
                    </span>
                </li>
                <li class="detail">
                    <span class="name">Invoice address:</span>
                    <span class="value">
                        <x-address
                            :address="$order->invoice_address"
                        />
                    </span>
                </li>
            </ul>       
           
            <div class="content">
                <h2>Order's content</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Title 
                                </th>
                                <th>
                                    ID 
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->books as $book) 
                                <tr>
                                    <td>
                                        {{ $book->title }}
                                    </td>
                                    <td>
                                        {{ $book->id }}
                                    </td>
                                    <td>
                                        {{ $book->pivot->price }} RON
                                    </td>
                                    <td>
                                        {{ $book->pivot->quantity }}
                                    </td>
                                    <td>
                                        {{ $book->pivot->price * $book->pivot->quantity }} RON
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>
                                    Shipping tax
                                </td>
                                <td></td>
                                <td>
                                    {{ $order->shipping_method->price }} RON
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    {{ $order->shipping_method->price }} RON
                                </td>
                            
                            </tr>
                            <tr>
                                <td>
                                    Total
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    {{ $order->totalQuantity }}
                                </td>
                                <td>
                                    {{ $order->totalPrice }} RON
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    
            <div class="action">
                <a class="link" href="{{ route('admin-orders.edit', ['order'=>$order->id]) }}">Edit</a>
    
                <form method="POST" action="{{ route('admin-orders.destroy', ['order'=>$order->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button button-primary">Delete</button>
                </form>
            </div>
        </div>
              
    </div>

@endsection