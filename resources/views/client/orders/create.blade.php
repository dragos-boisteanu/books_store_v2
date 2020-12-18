@extends('layouts.app')

@section('content')
    <div id="order">
        <div class="order__producs">
            <h2>Produse</h2>
            <table>
                <tr>
                    <th>
                        Produs
                    </th>
                    <th>
                        Cantitate
                    </th>
                    <th>
                        Pret unitar
                    </th>
                    <th>
                        Pret final
                    </th>
                </tr>
                @foreach($books as $book) 
                    <tr>
                        <td>
                            <a href="{{ route('books-client.show', ['id'=>$book->id]) }}">{{ $book->title}}</a>
                            
                        </td>
                        <td>
                            <update-cart-quantity-component
                                bookid={{ $book->id }}
                                quantity= {{ $book->quantity }}
                            ></update-cart-quantity-component>   
                        </td>
                        <td>
                            {{ $book->unitPrice }}
                        </td>
                        <td>
                            {{ $book->finalPrice }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td>
                        Total
                    </td>
                    <td colspan="3">
                        {{ $total }}
                    </td>
                </tr>
            </table>
        </div>
        <form method="POST" action="{{ route('orders-client.store')}}"> 
            @csrf          

            <div class="order__addresses">
                <h2>Addresses</h2>
                <div class="address">
                    <h3>Shipping address</h3>
                    @if (count($addresses) > 0)
                        <x-addresses-select
                            name="shipping_address"
                            title="Select Shipping address"
                            :addresses="$addresses"
                        />

                        {{-- <select name="shipping_address">
                            <option>
                                Select Shipping address
                            </option>
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}" {{ $address->default_for_shipping ? 'selected' : '' }}>
                                    {{ $loop->iteration . ' - ' . $address->first_name . ' ' . $address->name . ' ' . $address->address  . ' ' . $address->county->name . ' ' . $address->city->name . ' ' . $address->phone_number }}
                                </option>
                            @endforeach
                        </select> --}}
                    @else
                        <div>
                            <div>
                                <div>
                                    <label>Prenume</label>
                                    <input type="text" name="first_name"/>
                                </div>
                                <div>
                                    <label>Nume</label>
                                    <input type="text" name="name"/>
                                </div>
                            </div>
                            <div>
                                <label>Telefon</label>
                                <input type="text" name="phone_number"/>
                            </div>
    
                            <county-city-component
                                counties="{{ $counties }}"
                                @county-selected="saveCounty"
                                @city-selected="saveCity"
                            ></county-city-component>
    
                            <input type="hidden" name="county_id" :value="county"/>
                            <input type="hidden" name="city_id" :value="city"/>
    
                            <div>
                                <label>Adresa</label>
                                <input type="text" name="address"/>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="address" v-if="!showInvoiceAddress">
                    <h3>Invoice address</h3>
                    @if (count($addresses) > 0)
                        <x-addresses-select
                            name="invoice_address"
                            title="Select Invoice address"
                            :addresses="$addresses"
                        />
                        {{-- <select name="invoice_address">
                            <option>
                                Select Shipping address
                            </option>
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}" {{ $address->default_for_invoice ? 'selected' : '' }}>
                                    {{ $loop->iteration . ' - ' . $address->first_name . ' ' . $address->name . ' ' . $address->address  . ' ' . $address->county->name . ' ' . $address->city->name . ' ' . $address->phone_number }}
                                </option>
    
                            @endforeach
                        </select> --}}
                    @else
                        <div>
                            <div>
                                <div>
                                    <label>Prenume</label>
                                    <input type="text" name="i_first_name"/>
                                </div>
                                <div>
                                    <label>Nume</label>
                                    <input type="text" name="i_name"/>
                                </div>
                            </div>
                            <div>
                                <label>Telefon</label>
                                <input type="text" name="i_phone_number"/>
                            </div>
    
                            <county-city-component
                                counties="{{ $counties }}"
                                @county-selected="saveCounty"
                                @city-selected="saveCity"
                            ></county-city-component>
    
                            <input type="hidden" name="i_county_id" :value="county"/>
                            <input type="hidden" name="i_city_id" :value="city"/>
    
                            <div>
                                <label>Adresa</label>
                                <input type="text" name="i_address"/>
                            </div>
                        </div>
                    @endif
                </div>
                
            </div>

            <div>
                <input type="checkbox" id="useAsInvoice" checked v-on:change="toggleInvoiceAddress" name="useAsInvoice"/>
                <label for="useAsInvoice">Use the shipping address as invoice address</label>
            </div>

            <div>
                <h3>Shipping method</h3>
                @foreach ($shippingMethods as $shippingMethod)
                    <div>
                        <input id="{{$shippingMethod->name}}" type="radio" name="shippingMethod" value="{{$shippingMethod->id}}">
                        <label for="{{$shippingMethod->name}}">{{$shippingMethod->description}} {{ $shippingMethod->price }} RON</label>
                    </div>
                @endforeach
            </div>

            <div>
                <h3>Payment method</h3>
                @foreach ($paymentMethods as $paymentMethod)
                    <div>
                        <input id="{{$paymentMethod->name}}" type="radio" name="paymentMethod" value="{{$paymentMethod->id}}">
                        <label for="{{$paymentMethod->name}}">{{$paymentMethod->name}}</label>
                    </div>
                @endforeach
            </div>
            
            <button type="submit">Place order</button>
            


        </form>
    </div>
@endsection


@push('vue-scripts')
    <script>
        new Vue({
            el: '#order',

            data() {
                return {
                    showInvoiceAddress: true,
                    county: 0,
                    city: 0
                }
              
            },

            created() {
                console.log('vue instance from order');
            },

            methods: {
                toggleInvoiceAddress() {
                    this.showInvoiceAddress = !this.showInvoiceAddress;
                },

                saveCounty(countyId) {
                    this.county = countyId;
                },

                saveCity(cityId) {
                    this.city = cityId;
                }, 

                updateItemQuantity() {
                    axios.put(``)
                }
            }  
        });


    </script>

@endpush