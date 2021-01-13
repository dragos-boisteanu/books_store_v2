@extends('layouts.app')

@section('content')

    <div class="view">
        @include('includes.user-account-nav')
        <div class="view__content">
            <h1 class="view__header">
                My Orders
            </h1>
            <div>
                <form method="GET" action="{{ route('client-orders.index') }}">
                    <div>
                        <label for="id">Search order by id</label>
                        <input type="number" id="id" name="id" value="{{ old('id') }}"/>
                    </div>
                    <button type="submit">Search</button>
                </form>
                <form method="GET" action="{{ route('client-orders.index') }}">
                    <button type="submit">Reset</button>
                </form>
            </div>
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
                            <a href="{{ route('client-orders.show', ['order'=>$order->id]) }}">View order</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        
       
    </div>

@endsection