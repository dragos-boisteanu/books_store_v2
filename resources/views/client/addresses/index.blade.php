@extends('layouts.app')

@section('content')

    <div class="view">
        @include('includes.user-account-nav')
        <div class="view__content">
            <h1>
                My addresses
            </h1>
            <div class="standard__addresses">
                <div class="address">
                    <h6>Invoice default address</h6>
                    @foreach($addresses as $invoiceAddress)
                        @if($invoiceAddress->default_for_invoice)
                            <x-address :address="$invoiceAddress"/>
                            <div class="address__actions">
                                <a href="{{ route('client-addresses.edit', ['address'=>$invoiceAddress->id]) }}" class="link">Edit invoice address</a>
                            </div>
                            @break
                        @endif
                    @endforeach
                </div>
                <div class="address">
                    <h6>Shipping default address</h6>
                    @foreach($addresses as $shippingAddress)
                        @if($shippingAddress->default_for_shipping)
                            <x-address :address="$shippingAddress"/>  
                            <div class="address__actions">
                                <a href="{{ route('client-addresses.edit', ['address'=>$shippingAddress->id]) }}" class="link">Edit shipping address</a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="addresses">
                <h4>More addresses</h4>
                <ul class="list addresses__list">
                    @foreach($addresses as $address)
                        @if(!$address->default_for_shipping && !$address->default_for_invoice)
                            <li class="address">
                                <x-address :address="$address"/>                        
                                <div class="address__actions">
                                    <a href="{{ route('client-addresses.edit', ['address'=>$address->id]) }}" class="link address__action">Edit address</a>
                                    <span class="separator">
                                        |
                                    </span>
                                    <form method="POST" action="{{ route('client-addresses.delete', ['address'=>$address->id]) }}" class="address__action">
                                        @csrf
                                        @method('delete')
    
                                        <button type="submit" class="button button--small button-primary">Delete address</button>
                                    </form>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <div class="view__action">
                    <a href="{{ route('client-addresses.create') }}" class="link">Add new address</a>
                </div>
            </div>
        </div>
    </div>

@endsection
