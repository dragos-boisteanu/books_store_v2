@extends('layouts.app')

@section('content')

    <div class="view">
        <h1>
            My addresses
        </h1>
        <div class="standard__addresses">
            <div class="address">
                <h2>Invoice default address</h2>
                @foreach($addresses as $invoiceAddress)
                    @if($invoiceAddress->default_for_invoice)
                        <x-address :address="$invoiceAddress"/>
                        <div>
                            <a href="{{ route('addresses-client.edit', ['address'=>$invoiceAddress->id]) }}">Edit shipping address</a>
                        </div>
                        @break
                    @endif
                @endforeach
            </div>
            <div class="address">
                <h2>Shipping default address</h2>
                @foreach($addresses as $shippingAddress)
                    @if($shippingAddress->default_for_shipping)
                        <x-address :address="$shippingAddress"/>  
                        <div>
                            <a href="{{ route('addresses-client.edit', ['address'=>$shippingAddress->id]) }}">Edit shipping address</a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div>
            <h2>More addresses</h2>
            <ul class="list addresses_list">
                @foreach($addresses as $address)
                    @if(!$address->default_for_shipping && !$address->default_for_invoice)
                        <li class="address">
                            <div>
                                {{ $address->first_name . ' ' . $address->name }}
                            </div>
                            <div>
                                {{ $address->address }}
                            </div>
                            <div>
                                {{ $address->county->name }}, {{ $address->city->name}}
                            </div>
                            <div>
                                {{ $address->phone_number }}
                            </div>
                            <div>
                                <a href="{{ route('addresses-client.edit', ['address'=>$address->id]) }}">Edit address</a>
                                <form method="POST" acction="{{ route('addresses-client.delete', ['address'=>$address->id]) }}"></form>
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit">Delete address</button>
                                </form>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div>
                <a href="{{ route('addresses-client.create') }}">Add new address</a>
            </div>
        </div>
        
    </div>

@endsection
