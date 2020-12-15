@extends('layouts.app')

@section('content')

    <div class="view">
        <h1>
            My addresses
        </h1>
        <div class="standard__addresses">
            <div class="address">
                <h2>Invoice standard address</h2>
                @foreach($addresses as $invoiceAddress)
                    @if($invoiceAddress->default_for_invoice == 1)
                        <div>
                            <div>
                                {{ $invoiceAddress->first_name . ' ' . $invoiceAddress->name }}
                            </div>
                            <div>
                                {{ $invoiceAddress->address }}
                            </div>
                            <div>
                                {{ $invoiceAddress->county->name }}, {{ $invoiceAddress->city->name}}
                            </div>
                            <div>
                                {{ $invoiceAddress->phone_number }}
                            </div>
                            <div>
                                <a href="{{ route('addresses-client.edit', ['address'=>$invoiceAddress->id]) }}">Edit invoice address</a>
                            </div>
                        </div>
                        @break
                    @endif
                @endforeach
            </div>
            <div class="address">
                <h2>Shipping standard address</h2>
                @foreach($addresses as $shippingAddress)
                    @if($shippingAddress->default_for_shipping == 1)
                        <div>
                            <div>
                                {{ $shippingAddress->first_name . ' ' . $shippingAddress->name }}
                            </div>
                            <div>
                                {{ $shippingAddress->address }}
                            </div>
                            <div>
                                {{ $shippingAddress->county->name }}, {{ $shippingAddress->city->name}}
                            </div>
                            <div>
                                {{ $shippingAddress->phone_number }}
                            </div>
                            <div>
                                <a href="{{ route('addresses-client.edit', ['address'=>$shippingAddress->id]) }}">Edit shipping address</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div>
            <h2>More addresses</h2>
            <ul class="list addresses_list">
                @foreach($addresses as $shippingAddress)
                    @if($shippingAddress->default_for_shipping !== 1 || $shippingAddress->default_for_invoice !== 1)
                        <li class="address">
                            <div>
                                {{ $shippingAddress->first_name . ' ' . $shippingAddress->name }}
                            </div>
                            <div>
                                {{ $shippingAddress->address }}
                            </div>
                            <div>
                                {{ $shippingAddress->county->name }}, {{ $shippingAddress->city->name}}
                            </div>
                            <div>
                                {{ $shippingAddress->phone_number }}
                            </div>
                            <div>
                                <a href="{{ route('addresses-clinet.edit', ['address'=>$address->id]) }}">Edit address</a>
                                <form method="POST" acction="{{ route('addresses-clinet.delete', ['address'=>$addres->id]) }}"></form>
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
