@extends('layouts.app')

@section('content')

    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            <h1 class="view__header">
                Order {{ $order->id }} # - {{ $order->status->name }} - @if($order->deleted_at) DISABLED @endif
            </h1>
            <div class="date">
                {{ $order->created_at }}
            </div>
            <div>
                Operator: <a class="link" href="{{ route('admin-users.show', ['user'=>$order->operator->id]) }}">{{ $order->operator->first_name , ' ' . $order->operator->name }}</a>
            </div>
            <div class="addresses__container">
                <div class="address">
                    <h2>
                        Shipping address
                    </h2>
                    <div>
                        <x-address
                            :address="$order->shipping_address"
                        />
                    </div>
                </div>
                <div class="address">
                    <h2>
                        Invoice address
                    </h2>
                    <div>
                        <x-address
                            :address="$order->invoice_address"
                        />
                    </div>
                </div>
            </div>
            <div class="methods">
                <div class="method">
                    <h2>Payment method</h2>
                    <div>
                        {{ $order->payment_method->name }}
                    </div>
                </div>
                <div class="method">
                    <h2>Shipping method</h2>
                    <div>
                        {{ $order->shipping_method->name }}
                    </div>
                </div>
            </div>
            <div class="content">
                <h2>Ordered books</h2>
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
                                    {{ $book->pivot->price }}
                                </td>
                                <td>
                                    {{ $book->pivot->quantity }}
                                </td>
                                <td>
                                    {{ $book->pivot->price * $book->pivot->quantity }}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>
                                    Shipping tax
                                </td>
                                <td></td>
                                <td>
                                    {{ $order->shipping_method->price }}
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    {{ $order->shipping_method->price }}
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
                                    {{ $order->totalPrice }}
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