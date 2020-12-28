@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <h1>Orders list</h1>
        <div class="filter">
            <form method="GET" action="{{ route('admin-orders.index')}}">

                <input type="number" name="id" placeholder="Order ID" value="{{ old('id') }}"/>
                <input type="number" name="client" placeholder="Deliver to ID" value="{{ old('client') }}"/>
                <input type="number" name="operator" placeholder="Operator ID" value="{{ old('operator') }}" />

                <select name="status">
                    <option value="0" disabled selected>Status</option>
                    @foreach($statuses as $status)
                        <option value=" {{ $status->id }}" {{ old('status') == $status->id ? 'selected' : '' }}>{{ $status->name}}</option>
                    @endforeach
                </select>

                <select name="avaiable">
                    <option value="0" selected disabled>Avaiable</option>
                    <option value="1" {{ old('avaiable') == 1 ? 'selected' : ''}}>True</option>
                    <option value="2" {{ old('avaiable') == 2 ? 'selected' : ''}}>False</option>
                </select>

                <select name="shipping_method">
                    <option value="0" disabled selected>Shipping method</option>
                    @foreach($shipping_methods as $shipping_method)
                        <option value="{{ $shipping_method->id }}" {{ old('shipping_method') == $shipping_method->id ? 'selected' : ''}}>{{ $shipping_method->name}}</option>
                    @endforeach
                </select>

                <select name="payment_method">
                    <option value="0" disabled selected>Payment method</option>
                    @foreach($payment_methods as $payment_method)
                        <option value="{{ $payment_method->id }}" {{ old('payment_method') == $payment_method->id ? 'selected' : ''}}>{{ $payment_method->name}}</option>
                    @endforeach
                </select>

                <label for="created-at-after">Added after</label>
                <input type="date" id="created-at-after" name="created_at_start" value="{{ old('created_at_start') }}">

                <label for="created-at-before">Added before</label>
                <input type="date" id="created-at-before" name="created_at_end" value="{{ old('created_at_end') }}">

                <label for="updated-at-after">Updated after</label>
                <input type="date" id="updated-at-after" name="updated_at_start" value="{{ old('updated_at_start') }}">

                <label for="updated-at-before">Updated before</label>
                <input type="date" id="updated-at-before" name="updated_at_end" value="{{ old('updated_at_end') }}">

                <button type="submit">Filter</button>

            </form>

            
            <form method="GET" action="{{ route('admin-orders.index')}}">
                <button>Clear</button>
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
                    Client ID
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
                    {{ $order->user->id }}
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
