@extends('layouts.app')

@section('content')
    <div id="order" class="view create-order">
        <div class="view__content">
            <h1>Place order</h1>
            <div class="order__producs">
                <h2>Items</h2>
                <table>
                    <thead>
                        <tr>
                            <th>
                                Book
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Unit Price
                            </th>
                            <th>
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book) 
                            <tr>
                                <td>
                                    <a class="link" href="{{ route('books.show', ['id'=>$book->id]) }}">{{ $book->title}}</a>
                                    
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
                        <tr class="total-row">
                            <td>
                                Total
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                {{ $total }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <form method="POST" action="{{ route('client-orders.store')}}"> 
                @csrf          
                
                <div class="order__addresses">
                    <h2>Addresses</h2>
                    <div class="form-section">
                        <div class="address">
                            <h3>Shipping address</h3>
                            @if (count($addresses) > 0)
                                <x-addresses-select
                                    name="shipping_address"
                                    title="Select shipping address"
                                    :addresses="$addresses"
                                />
                            @else
                                <div class="form-section">
                                    <div class="form-group">
                                        <label class="form-label">Prenume</label>
                                        <input type="text" name="first_name" class="form-input"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nume</label>
                                        <input type="text" name="name" class="form-input"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Telefon</label>
                                    <input type="text" name="phone_number" class="form-input"/>
                                </div>
        
                                <county-city-component
                                    counties="{{ $counties }}"
                                    @county-selected="saveCounty"
                                    @city-selected="saveCity"
                                ></county-city-component>
        
                                <input type="hidden" name="county_id" :value="county"/>
                                <input type="hidden" name="city_id" :value="city"/>
        
                                <div class="form-group">
                                    <label class="form-label">Adresa</label>
                                    <input type="text" name="address" class="form-input"/>
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
                            @else
                                <div class="form-section">
                                    <div class="form-group">
                                        <label class="form-label">Prenume</label>
                                        <input type="text" name="i_first_name" class="form-input"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nume</label>
                                        <input type="text" name="i_name" class="form-input"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Telefon</label>
                                    <input type="text" name="i_phone_number" class="form-input"/>
                                </div>
        
                                <county-city-component
                                    counties="{{ $counties }}"
                                    @county-selected="saveCounty"
                                    @city-selected="saveCity"
                                ></county-city-component>
        
                                <input type="hidden" name="i_county_id" :value="county"/>
                                <input type="hidden" name="i_city_id" :value="city"/>
        
                                <div class="form-group">
                                    <label class="form-label">Adresa</label>
                                    <input type="text" name="i_address" class="form-input"/>
                                </div>
                            @endif
                        </div>           
                    </div>
                    
                </div>

                <div>
                    <input type="checkbox" id="useAsInvoice" checked v-on:change="toggleInvoiceAddress" name="useAsInvoice"/>
                    <label for="useAsInvoice">Use the shipping address as invoice address</label>
                </div>
    
                <div class="form-section radio-section">
                    <div>
                        <h3>Shipping method</h3>
                        @foreach ($shippingMethods as $shippingMethod)
                            <div class="form-radio__group">
                                <input id="{{$shippingMethod->name}}" type="radio" name="shippingMethod" value="{{$shippingMethod->id}}" class="radio-input">
                                <label for="{{$shippingMethod->name}}" class="radio-label">
                                    <span class="name">
                                        {{$shippingMethod->description}}
                                    </span> 
                                    <span class="value">
                                        {{ $shippingMethod->price }} RON
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
        
                    <div>
                        <h3>Payment method</h3>
                        @foreach ($paymentMethods as $paymentMethod)
                            <div class="form-radio__group">
                                <input id="{{$paymentMethod->name}}" type="radio" name="paymentMethod" value="{{$paymentMethod->id}}" class="radio-input">
                                <label for="{{$paymentMethod->name}}">{{$paymentMethod->name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="form-action">
                    <button type="submit" class="button button-primary">Place order</button>
                </div>
               
                
            </form>
        </div>
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