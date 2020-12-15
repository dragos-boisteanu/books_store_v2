@extends('layouts.app')

@section('content')
    <div id="view" class="view">
        <h1>
            Edit address
        </h1>
        <form class="address" method="POST" action="{{ route('addresses-client.update', ['address'=>$address->id]) }}">
            @csrf
            @method('PATCH')

            <div>
                <div>
                    <label for="first-name">First name</label>
                    <input type="text" id="first-name" name="first_name" value="{{ $address->first_name }}"/>
                   
                </div>
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ $address->name }}"/>
                </div>
            </div>
            
            <div>
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="{{ $address->address }}"/>
            </div>

            <county-city-component
                counties="{{ $counties }}"
                selectedcounty="{{ $address->county->id }}"
                selectedcity="{{ $address->city->id }}"
                @county-selected="saveCounty"
                @city-selected="saveCity"
            ></county-city-component>

            <input type="hidden" name="county" :value="county"/>
            <input type="hidden" name="city" :value="city"/>
                
            <div>
                <label for="phone-number">Phone Number</label>
                <input type="text" id="phone-number" name="phone_number" value="{{ $address->phone_number }}"/>
            </div>
            <div>
                <button type="submit">Save address</button>
            </div>
        </form>
    </div>
@endsection


@push('vue-scripts')
    <script>
        new Vue({
            el: '#view',

            data() {
                return {
                    county: 0,
                    city: 0
                }
            },

            methods: {
                saveCounty(countyId) {
                    this.county = countyId;
                },

                saveCity(cityId) {
                    this.city = cityId;
                }, 
            }
        })
    </script>
@endpush