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
            Client: <a href="{{ route('admin-users.show', ['user'=>$order->user->id]) }}">{{ $order->user->first_name . ' ' . $order->user->name }}</a>
        </div>
        <form method="POST" action="{{ route('admin-orders.update', ['order'=>$order->id])}}">
            @csrf
            @method("PUT")

            <div>
                Operator: 
    
                <select name="operators">
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
                <select>
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
                        <select name="shipping_address">
                            <option value="0" disabled>Select shipping address</option>
                            @foreach($user_addresses as $address)
                                <option value="{{ $address->id }}" {{ $order->shipping_address->id === $address->id ? 'selected' : ''}}>
                                    {{ $loop->iteration . ' - ' . $address->first_name . ' ' . $address->name . ' ' . $address->address  . ' ' . $address->county->name . ' ' . $address->city->name . ' ' . $address->phone_number }}                                
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="address">
                    <h2>
                        Invoice address
                    </h2>
                    <div>
                        <select name="invoice_address">
                            <option value="0" disabled>Select invoice address</option>
                            @foreach($user_addresses as $address)
                                <option value="{{ $address->id }}" {{ $order->invoice_address->id === $address->id ? 'selected' : ''}}>
                                    {{ $loop->iteration . ' - ' . $address->first_name . ' ' . $address->name . ' ' . $address->address  . ' ' . $address->county->name . ' ' . $address->city->name . ' ' . $address->phone_number }}                                
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="methods">
                <div class="method">
                    <h2>Payment method</h2>
                    <div>
                        <select name="payment_method">
                            <option value="0">Select payment method</option>
                            @foreach($payment_methods as $payment_method)
                                <option value="{{ $payment_method->id }}" {{ $order->payment_method->id === $payment_method->id ? 'selected' : ''}}>
                                    {{$payment_method->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="method">
                    <h2>Shipping method</h2>
                    <div>
                        <select name="shipping_method">
                            <option value="0">Select payment method</option>
                            @foreach($shipping_methods as $shipping_method)
                                <option value="{{ $shipping_method->id }}" {{ $order->shipping_method->id === $shipping_method->id ? 'selected' : ''}}>
                                    {{$shipping_method->name }}
                                </option>
                            @endforeach
                        </select>
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
            <div>
                <button type="submit">Save</button>
            </div>
        </form>        
       
    </div>

@endsection