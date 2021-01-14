@extends('layouts.app')

@section('content')
    <div id="view" class="view">
        @include('includes.user-account-nav')
        <div class="view__content">
            <h1>
                Create address
            </h1>
            <form method="POST" action="{{ route('client-addresses.store') }}">
                @csrf
    
                <div class="form-section">
                    <div class="form-group">
                        <label for="first-name" class="form-label">First name</label>
                        <input type="text" id="first-name" name="first_name" class="form-input"/>
                       
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-input"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" name="address" class="form-input"/>
                </div>
    
                <county-city-component
                    counties="{{ $counties }}"
                    @county-selected="saveCounty"
                    @city-selected="saveCity"
                ></county-city-component>
    
                <input type="hidden" name="county_id" :value="county"/>
                <input type="hidden" name="city_id" :value="city"/>
                    
                <div class="form-group">
                    <label for="phone-number" class="form-label">Phone Number</label>
                    <input type="text" id="phone-number" name="phone_number" class="form-input"/>
                </div>
    
                <div>
                    <input id="invoice" type="checkbox" name="default_for_invoice"/>
                    <label for="invoice">Default address for invoice</label>
                </div>
    
                <div>
                    <input id="shipping" type="checkbox" name="default_for_shipping"/>
                    <label for="shipping">Default address for shipping</label>
                </div>
    
                <div class="form-action">
                    <button type="submit" class="button button-primary">Save address</button>
                </div>
            </form>
        </div>
        
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