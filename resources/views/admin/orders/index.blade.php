@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <h1>Orders list</h1>
        <div class="filter">
            <form method="POST" action="{{ route('admin-orders.index')}}">
                @csrf

                <input type="text" name="id" placeholder="id"/>
                <input type="text" name="deliver_to" placeholder="deliver to"/>
                
                <select name="status">
                    <option value="0" disabled selected>Status</option>
                    @foreach($statuses as $statuse)
                        <option value=" {{ $statuse->id }}">{{ $statuse->name}}</option>
                    @endforeach
                </select>

                <select name="shipping_method">
                    <option value="0" disabled selected>Shipping method</option>
                    @foreach($shipping_methods as $shipping_method)
                        <option value=" {{ $shipping_method->id }}">{{ $shipping_method->name}}</option>
                    @endforeach
                </select>

                <select name="payment_method">
                    <option value="0" disabled selected>Payment method</option>
                    @foreach($payment_methods as $payment_method)
                        <option value=" {{ $payment_method->id }}">{{ $payment_method->name}}</option>
                    @endforeach
                </select>

                <label>Created between</label>
                <input type="date" name="created_at_start">
                <input type="date" name="created_at_end">

                <label for="updated_at">Last modifed between</label>
                <input type="date" name="updated_at_start">
                <input type="date" name="updated_at_end">

                <button type="submit">Filter</button>

            </form>
        </div>
        <table>
            <tr>
                <th>
                    Index
                </th>
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
                    Operator
                </th>
                <th>
                   Total
                </th>
                <th>
                    Disabled
                </th>
                <th>
                    Created at
                </th>
                <th>
                    Last modified at
                </th>
                <th>
                    
                </th>
            </tr>
            @foreach($orders as $order)
            <tr>
                <th>
                    {{ $loop->iteration  }}
                </th>
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
                    {{ $order->operator->id }}
                </td>
                <td>
                    {{ $order->total_price }}
                </td>
                <td>
                    @if($order->deleted_at)
                        <span>
                            TRUE
                        </span>
                    @else
                        <span>
                            FALSE
                        </span>
                    @endif
                </td>
                <td>
                    {{ $order->created_at }}
                </td>
                <td>
                    {{ $order->updated_at }}
                </td>
                <td>
                    <a href="{{ route('admin-orders.show', ['order'=>$order->id]) }}" >Details</a>
                    <a href="{{ route('admin-orders.edit', ['order'=>$order->id]) }}" >Edit</a>
                </td>
            </tr>

            @endforeach

        </table>
            
        </ul>
        {{ $orders->links() }}
    </div>

    
@endsection
