@extends('layouts.app')

@section('content')
<div class="view">
    @include('includes.user-account-nav')
    <div class="view__content">
        {{ Breadcrumbs::render('orders-show', $order) }}
        <h1>
            Order #{{ $order->id }}  - {{ $order->status->name }}
        </h1>
        <div class="date">
            <span class="text">Created on:</span>
            <span class="value">{{ $order->created_at }}</span>
            <span class="text">Payment method:</span>
            <span class="value"> {{ $order->payment_method->name }} </span>
            <span class="text">Shipping method:</span>
            <span class="value"> {{ $order->shipping_method->name }} </span>
        </div>
        <div class="addresses__container">
            <div class="address">
                <h4>
                    Shipping address
                </h4>
                <div>
                    <x-address
                        :address="$order->shipping_address"
                    />
                </div>
            </div>
            <div class="address">
                <h4>
                    Invoice address
                </h4>
                <div>
                    <x-address
                        :address="$order->invoice_address"
                    />
                </div>
            </div>
        </div>
        <div class="content">
            <h2>Ordered books</h2>
            <table class="table">
                <thead>
                    <tr class="table__head">
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
                        <td colspan="">
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
                    <tr class="total-row">
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

        <div class="view__action">
            <a href="{{ route('client-orders.index') }}" class="link">Back to orders</a>
        </div>
    </div>
</div>

@endsection