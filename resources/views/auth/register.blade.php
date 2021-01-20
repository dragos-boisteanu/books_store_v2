@extends('layouts.app')

@section('content')
<div id="view" class="view">
    <div class="view__content view__content--center">
        <form method="POST" action="{{ route('register') }}" @submit.prevent="validate">
            @csrf
            <h1>Register</h1>
            <div class="form-group">
                <label for="first_name" class="form-label">First name</label>
            
                <input id="first_name" type="text" class="form-input" name="first_name" v-model="firstName">

                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror

                <span v-if="errors.firstName.show" class="invalid-feedback" role="alert">
                    @{{ errors.firstName.message }}
                </span>
    
            </div>

            <div class="form-group row">
                <label for="name" class="form-label">Name</label>

                <input id="name" type="text" class="form-input" name="name" v-model="name">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror

                <span v-if="errors.name.show" class="invalid-feedback" role="alert">
                    @{{ errors.name.message }}
                </span>

            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>

                <input id="email" type="text" class="form-input" name="email" v-model="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror

                <span v-if="errors.email.show" class="invalid-feedback" role="alert">
                    @{{ errors.email.message }}
                </span>
                
            </div>

            <div class="form-group">
                <label for="phone_number" class="form-label">Phone number</label>

                    <input id="phone_number" type="text" class="form-input @error('phone_number') is-invalid @enderror" name="phone_number" v-model="phoneNumber">

                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror

                    <span v-if="errors.phoneNumber.show" class="invalid-feedback" role="alert">
                        @{{ errors.phoneNumber.message }}
                    </span>


            </div>

           <div class="form-group">
                <label for="password" class="form-label">Password</label>

                <input id="password" type="password" class="form-input" name="password" v-model="password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror

                <span v-if="errors.password.show" class="invalid-feedback" role="alert">
                    @{{ errors.password.message }}
                </span>

            </div>

            <div class="form-group">
                <label for="password-confirm" class="form-label">Confirm password</label>

                <input id="password-confirm" type="password" class="form-input" name="password_confirmation" v-model="confirmPassword">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror

                <span v-if="errors.confirmPassword.show" class="invalid-feedback" role="alert">
                    @{{ errors.confirmPassword.message }}
                </span>
            </div>

            <div class="form-action">
                <button type="submit"  class="button button-primary">
                    Register
                </button>
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
                    firstName: '{{ old('first_name') }}',
                    name: '{{ old('name') }}',
                    email: '{{ old('email') }}',
                    phoneNumber: '{{ old('phone_number') }}',
                    password: '',
                    confirmPassword: '',

                    errorsCounter: 0,

                    errors: {
                        firstName: {
                            show: false,
                            message: ''
                        },

                        name: {
                            show: false,
                            message: ''
                        },

                        email: {
                            show: false,
                            message: ''
                        },

                        phoneNumber: {
                            show: false,
                            message: ''
                        },

                        password: {
                            show: false,
                            message: ''
                        },
                        confirmPassword: {
                            show: false,
                            message: ''
                        },
                       
                    }
                }
            },

            methods: {
                validate() {

                    let errors = 0;

                    if(!this.firstName) {
                        this.errors.firstName.show = true;
                        this.errors.firstName.message = 'First name is required'
                        this.errorsCounter++;
                    }else {
                        this.errors.firstName.show = false;
                        this.errors.firstName.message = ''
                    }

                    if(!this.name) {
                        this.errors.name.show = true;
                        this.errors.name.message = 'Name is required'
                        this.errorsCounter++;
                    }else {
                        this.errors.name.show = false;
                        this.errors.name.message = ''
                    }

                    if(!this.email) {
                        this.errors.email.show = true;
                        this.errors.email.message = 'Email is required'
                        this.errorsCounter++;
                    }else {
                        this.errors.email.show = false;
                        this.errors.email.message = ''
                    }

                    if(!this.phoneNumber) {
                        this.errors.phoneNumber.show = true;
                        this.errors.phoneNumber.message = 'Phone number is required'
                        this.errorsCounter++;
                    }else {
                        this.errors.phoneNumber.show = false;
                        this.errors.phoneNumber.message = ''
                    }

                    if(!this.password) {
                        this.errors.password.show = true;
                        this.errors.password.message = 'Password is required'
                        this.errorsCounter++;
                    }else {
                        this.errors.password.show = false;
                        this.errors.password.message = ''
                    }

                    if(!this.confirmPassword) {
                        this.errors.confirmPassword.show = true;
                        this.errors.confirmPassword.message = 'Password confirmation is required'
                        this.errorsCounter++;
                    }else {
                        this.errors.confirmPassword.show = false;
                        this.errors.confirmPassword.message = ''
                    }

                    if(this.errorsCounter === 0) {
                        return true;
                    }

                    
                }
            }
        })
    </script>
@endpush