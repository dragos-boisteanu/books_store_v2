@extends('layouts.app')

@section('content')
    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            <h1>Orders list</h1>
            <div class="filter-container">
                <h2>Filter</h2>
                <form method="GET" action="{{ route('admin-orders.index')}}">
                
                    <div class="filter">
                        <div class="form-group">
                            <div class="form-group">
                                <input type="number" class="form-input" name="id" placeholder="Order ID" value="{{ old('id') }}"/>
                            </div>
                            
                            <div class="form-group">
                                <input type="number" class="form-input" name="client" placeholder="Deliver to ID" value="{{ old('client') }}"/>
                            </div>
                            
                            <div class="form-group">
                                <input type="number" class="form-input" name="operator" placeholder="Operator ID" value="{{ old('operator') }}" />
                            </div class="form-group">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <select name="status" class="form-input">
                                    <option value="0" disabled selected>Status</option>
                                    @foreach($statuses as $status)
                                        <option value=" {{ $status->id }}" {{ old('status') == $status->id ? 'selected' : '' }}>{{ $status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <select name="avaiable" class="form-input">
                                    <option value="0" selected disabled>Avaiable</option>
                                    <option value="1" {{ old('avaiable') == 1 ? 'selected' : ''}}>True</option>
                                    <option value="2" {{ old('avaiable') == 2 ? 'selected' : ''}}>False</option>
                                </select>
                            </div>
                           
                            <div class="form-group">
                                <select name="shipping_method" class="form-input">
                                    <option value="0" disabled selected>Shipping method</option>
                                    @foreach($shipping_methods as $shipping_method)
                                        <option value="{{ $shipping_method->id }}" {{ old('shipping_method') == $shipping_method->id ? 'selected' : ''}}>{{ $shipping_method->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <select name="payment_method" class="form-input">
                                    <option value="0" disabled selected>Payment method</option>
                                    @foreach($payment_methods as $payment_method)
                                        <option value="{{ $payment_method->id }}" {{ old('payment_method') == $payment_method->id ? 'selected' : ''}}>{{ $payment_method->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="created-at-after" class="form-label">Added after</label>
                                <input type="date" class="form-input" id="created-at-after" name="created_at_start" value="{{ old('created_at_start') }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="created-at-before" class="form-label">Added before</label>
                                <input type="date" class="form-input" id="created-at-before" name="created_at_end" value="{{ old('created_at_end') }}">
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="updated-at-after" class="form-label">Updated after</label>
                                <input type="date" class="form-input" id="updated-at-after" name="updated_at_start" value="{{ old('updated_at_start') }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="updated-at-before" class="form-label">Updated before</label>
                                <input type="date" class="form-input"  id="updated-at-before" name="updated_at_end" value="{{ old('updated_at_end') }}">
                            </div>
                        </div>
                    </div>
                
                    <div class="filter__actions">
                        <button type="submit" class="button button-primary">Filter</button>
                        <button id="reset-btn" class="button button-primary">Reset</button>
                    </div>
                  

                </form>

                <form method="GET" id="reset-form" action="{{ route('admin-orders.index')}}" style="display: none">
                    
                </form>
            </div>
            <div class="table-container">
                <h2>Orders</h2>
                <table>
                    <thead>
                        <tr>
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
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
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
                                    <a class="link" href="{{ route('admin-orders.show', ['order'=>$order->id]) }}" >Details</a>
                                </td>
                                <td>
                                    <a class="link" href="{{ route('admin-orders.edit', ['order'=>$order->id]) }}" >Edit</a>
                                </td>
                            </tr>
    
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $orders->links() }}
        </div>
    </div>
@endsection


@push('vue-scripts')

    <script>
        const resetBtn = document.getElementById('reset-btn');
        const resetForm = document.getElementById('reset-form');

        resetBtn.addEventListener('click', (event) => {
            event.preventDefault();

            resetForm.submit();
        })
    </script>

@endpush