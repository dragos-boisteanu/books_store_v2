@extends('layouts.app')

@section('content')
    <div id="order">
        <div>
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
                            {{ $book->title}}
                        </td>
                        <td>
                            <form method="POST" action="/api/cart/{{ $cartId }}">
                                @csrf
                                @method('PUT')

                                <input type="number" name="quantity" value="{{ $book->quantity }}"/>
                                <input type="hidden" name="book_id" value="{{ $book->id }}"/>
                                <button type="submit">Actualizeaza</button>
                            </form>
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

            <h2>Adrese</h2>
            <div>
                @if (!isset($addresses))
                    <select>
                        <option name="delivery_address">
                            Selecteaza adresa de livrare
                        </option>
                        @foreach($addresses as $address)
                            <option value="{{ $address->id }}">
                                {{ $address->address }}

                            </option>

                        @endforeach
                    </select>
                @else
                    <h3>Adresa de livrare</h3>
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

                            <input type="hidden" name="county" :value="county"/>
                            <input type="hidden" name="city" :value="city"/>

                        <div>
                            <label>Adresa</label>
                            <input type="text" name="address"/>
                        </div>
                    </div>
                @endif
            </div>
            <div>
                <input type="checkbox" checked v-on:change="toggleInvoiceAddress" name="useAsInvoice"/>
                <label>Foloseste adresa pentru facturare</label>
            </div>
            <div>
                <h3>Metoda de livrare</h3>
                @foreach ($shippingMethods as $shippingMethod)
                    <div>
                        <input id="{{$shippingMethod->name}}" type="radio" name="shippingMethod" value="{{$shippingMethod->id}}">
                        <label for="{{$shippingMethod->name}}">{{$shippingMethod->description}} {{ $shippingMethod->price }} RON</label>
                    </div>
                @endforeach
            </div>
            <div>
                <h3>Metoda de plata</h3>
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
                } , 

                updateItemQuantity() {
                    axios.put(``)
                }
            }  
        });


    </script>

@endpush