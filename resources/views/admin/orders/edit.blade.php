@extends('layouts.app')

@section('content')

    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            <h1 class="view__header">
                Order {{ $order->id }} # - {{ $order->status->name }}
            </h1>
            <div class="date">
                {{ $order->created_at }}
            </div>
            <div>
                Client: <a href="{{ route('admin-users.show', ['user'=>$order->user->id]) }}">{{ $order->user->first_name . ' ' . $order->user->name }}</a>
            </div>
            <form method="POST" action="{{ route('admin-orders.update', ['order'=>$order->id])}}">
                @csrf
                @method("PUT")
    
                <div>
                    Operator: 
        
                    <select name="operator_id">
                        <option value="0" disabled>Select operator</option>
                        @foreach($operators as $operator)
                            <option value="{{ $operator->id }}" {{ $order->operator->id === $operator->id ? 'selected' : ''}}>
                                {{ $operator->id }} - {{ $operator->first_name . ' ' . $operator->name }} - Orders: {{ count($operator->operatorForOrders()) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <h3>Status</h3>
                    <select name="status_id">
                        <option value="0" disabled>Select order status</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $order->status->id === $status->id ? 'selected' : ''}}>{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="addresses__container">
                    <div class="address">
                        <h2>
                            Shipping address
                        </h2>
                        <div>
                            <x-addresses-select
                                name="shipping_address_id"
                                title="Select shipping address"
                                :id="$order->invoice_address_id"
                                :addresses="$user_addresses"
                            />
                        </div>
                    </div>
                    <div class="address">
                        <h2>
                            Invoice address
                        </h2>
                        <div>
                            <x-addresses-select
                                name="invoice_address_id"
                                title="Select invoice address"
                                :id="$order->invoice_address_id"
                                :addresses="$user_addresses"
                            />
                        </div>
                    </div>
                </div>
                <div class="methods">
                    <div class="method">
                        <h2>Payment method</h2>
                        <div>
                            <x-methods-select
                                name="payment_method_id"
                                title="Select payment method"
                                :id="$order->payment_method_id"
                                :methods="$payment_methods"
                            />
                        </div>
                    </div>
                    <div class="method">
                        <h2>Shipping method</h2>
                        <div>
                            <x-methods-select
                                name="shipping_method_id"
                                title="Select shipping method"
                                :id="$order->shipping_method_id"
                                :methods="$shipping_methods"
                            />
                        </div>
                    </div>
                </div>
                <div class="content">
                    <h2>Ordered books</h2>
                    <div class="table-container">

                    </div>
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
                <div>
                    <button type="submit">Save</button>
                </div>
            </form>        
            <form method="POST" action="{{ route('admin-orders.destroy', ['order'=>$order->id]) }}">
                @csrf
                @method('DELETE')
    
                <button type="submit">Delete</button>
    
            </form>    
        </div>   
    </div>

@endsection