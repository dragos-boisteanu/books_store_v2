@extends('layouts.app')

@section('content')

    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            {{ Breadcrumbs::render('dashboard-order.edit', $order) }}
            <h1 class="view__header">
                Order {{ $order->id }} # - {{ $order->status->name }} @if($order->deleted_at) - CANCELED @endif
            </h1>
            <ul class="details">
                <li class="detail">
                    <span class="name">
                        Created at:
                    </span>
                    <span class="value">
                        {{ $order->created_at }}
                    </span>
                </li>
                <li class="detail">
                    <span class="name">
                        Client: 
                    </span>
                    <span class="value">
                        <a class="link" href="{{ route('admin-users.show', ['user'=>$order->user->id]) }}">{{ $order->user->first_name . ' ' . $order->user->name }}</a>
                    </span>
                </li>
            </ul>
            <form method="POST" action="{{ route('admin-orders.update', ['order'=>$order->id])}}">
                @csrf
                @method("PUT")
    
                <div class="form-group">
                    <label class="form-label">Operator: </label>
        
                    <select name="operator_id" class="form-input">
                        <option value="0" disabled>Select operator</option>
                        @foreach($operators as $operator)
                            <option value="{{ $operator->id }}" {{ $order->operator->id === $operator->id ? 'selected' : ''}}>
                                {{ $operator->id }} - {{ $operator->first_name . ' ' . $operator->name }} - Orders: {{ count($operator->operatorForOrders()) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status_id" class="form-input">
                        <option value="0" disabled>Select order status</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $order->status->id === $status->id ? 'selected' : ''}}>{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        Shipping address
                    </label>
                    <x-addresses-select
                        name="shipping_address_id"
                        title="Select shipping address"
                        :id="$order->invoice_address_id"
                        :addresses="$user_addresses"
                    />
                </div>
                <div class="form-group">
                    <label class="form-label">
                        Invoice address
                    </label>
                    <x-addresses-select
                        name="invoice_address_id"
                        title="Select invoice address"
                        :id="$order->invoice_address_id"
                        :addresses="$user_addresses"
                    />
                </div>
                <div class="form-group">
                    <label class="form-label">Payment method</label>
                    <x-methods-select
                        name="payment_method_id"
                        title="Select payment method"
                        :id="$order->payment_method_id"
                        :methods="$payment_methods"
                    />
                </div>
                <div class="form-group">
                    <label class="form-label">Shipping method</label>
                    <x-methods-select
                        name="shipping_method_id"
                        title="Select shipping method"
                        :id="$order->shipping_method_id"
                        :methods="$shipping_methods"
                    />
                </div>
         
                <div class="form-action">
                    <button type="submit" class="button button-primary">Save</button>
                </div>
            </form>  
                
            <div class="table-container">
                <h2>Ordered books</h2>
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

            @if( isset($order->deleted_at))
                <form method="POST" action="{{ route('admin-orders.restore', ['order'=>$order->id]) }}">
                    @csrf
                    <button type="submit" class="button button-primary">Restore</button>
                </form>    
            @else
                <form method="POST" action="{{ route('admin-orders.destroy', ['order'=>$order->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button button-primary">Cancel</button>
                </form>
            @endif
        </div>   
    </div>

@endsection