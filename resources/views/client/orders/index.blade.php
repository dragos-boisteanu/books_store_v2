@extends('layouts.app')

@section('content')

    <div class="view">
        <h1 class="view__header">
            My Orders
        </h1>
        <table>
            <tr>
                <th>
                    Order #
                </th>
                <th>
                    Date 
                </th>
                <th>
                    Deliver to
                </th>
                <th>
                    Total
                </th>
                <th>
                    Status
                </th>
                <th></th>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>
                        {{ $order->id }}
                    </td>
                    <td>
                        {{ $order->created_at }}
                    </td>
                    <td>
                        {{ $order->shipping_address->first_name . ' ' . $order->shipping_address->name }}
                    </td>
                    <td>
                        {{ $order->totalPrice }}
                    </td>
                    <td>    
                        {{ $order->status->name}}
                    </td>
                    <td>
                        <a href="{{ route('orders-client.show', ['order'=>$order->id]) }}">View order</a>
                    </td>
                </tr>
            @endforeach
        </table>
       
    </div>

@endsection