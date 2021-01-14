@extends('layouts.app')

@section('content')

    <div class="view">
        @include('includes.user-account-nav')
        <div class="view__content">
            <h1 class="view__header">
                My Orders
            </h1>
            <div class="filter">
                <form method="GET" id="search-form" action="{{ route('client-orders.index') }}">
                    <div class="form-group">
                        <input type="text" name="id" class="form-input" value="{{ old('id') }}" placeholder="Order id"/>
                    </div>
                    <div class="form-action">
                        <button button type="submit" id="reset-button" class="button button-primary">Reset</button>
                        <button type="submit" class="button button-primary">Search</button>
                    </div>
                    
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr class="table__head">
                        <th>
                            Order #
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Date 
                        </th>
                        <th>
                            Deliver to
                        </th>
                        <th>
                            Quantity
                        </th>
                        <th>
                            Total
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                {{ $order->id }}
                            </td>
                            <td>    
                                {{ $order->status->name}}
                            </td>
                            <td>
                                {{ $order->created_at }}
                            </td>
                            <td>
                                {{ $order->shipping_address->first_name . ' ' . $order->shipping_address->name }}
                            </td>
                            <td>
                                {{ $order->totalQuantity }}
                            </td>
                            <td>
                                {{ $order->totalPrice }}
                            </td>
                            <td>
                                <a href="{{ route('client-orders.show', ['order'=>$order->id]) }}" class="link">View order</a>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>

@endsection


@push('js-scripts')

<script>
    const restButton = document.getElementById('reset-button');
    const searchForm = document.getElementById('search-form');

    restButton.addEventListener('click', function(event) {
        event.preventDefault()
        
        console.log(searchForm[0].value ='');

        searchForm.submit();
    })
</script>
@endpush