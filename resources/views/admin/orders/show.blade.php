@extends('layouts.app')

@section('content')

    <div class="view">
        <h1 class="view__header">
            Order {{ $order->id }} # - {{ $order->status->name }}
        </h1>
        <div class="date">
            {{ $order->created_at }}
        </div>
        <div>
            Operator: <a href="{{ route('admin-users.show', ['user'=>$order->operator->id]) }}">{{ $order->operator->first_name , ' ' . $order->operator->name }}</a>
        </div>
        <div class="addresses__container">
            <div class="address">
                <h2>
                    Shipping address
                </h2>
                <div>
                    {{ $order->shipping_address->id }}
                </div>
            </div>
            <div class="address">
                <h2>
                    Invoice address
                </h2>
                <div>
                    {{ $order->invoice_address->id }}
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
            <table>
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
            </table>
        </div>

        <div class="action">
            <a href="{{ route('orders-client.index') }}">Back to orders</a>
        </div>
        
       
    </div>

@endsection