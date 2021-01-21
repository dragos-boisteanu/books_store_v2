@extends('layouts.app')

@section('content')
<div id="view" class="view">
    <div class="view__content view__content--center">
        <form method="POST" action="{{ route('register') }}" @submit="validate">
            @csrf
            <h1>Register</h1>
            <div class="form-group">
                <label for="first_name" class="form-label">First name</label>
            
                <input id="first_name" type="text" class="form-input" name="first_name" v-model.trim="firstName">

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

                <input id="name" type="text" class="form-input" name="name" v-model.trim="name">

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

                <input id="email" type="text" class="form-input" name="email" v-model.trim="email">

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

                    <input id="phone_number" type="text" class="form-input @error('phone_number') is-invalid @enderror" name="phone_number" v-model.trim="phoneNumber">

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

                <input id="password" type="password" class="form-input" name="password" v-model.trim="password">

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

                <input id="password-confirm" type="password" class="form-input" name="password_confirmation" v-model.trim="confirmPassword">

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
                validate(event) {

                    if(!this.firstName) {
                        this.errors.firstName.show = true;
                        this.errors.firstName.message = 'The first name field is required.'
                        this.errorsCounter++;
                    }else {
                        this.errors.firstName.show = false;
                        this.errors.firstName.message = ''
                        this.errorsCounter - 1;
                    }

                    if(!this.name) {
                        this.errors.name.show = true;
                        this.errors.name.message = 'The name field is required.'
                        this.errorsCounter++;
                    }else {
                        this.errors.name.show = false;
                        this.errors.name.message = ''
                        this.errorsCounter - 1;
                    }

                    if(!this.email) {
                        this.errors.email.show = true;
                        this.errors.email.message = 'Email required'
                        this.errorsCounter++;
                    }else if(!this.validEmail(this.email)) {
                        this.errors.email.show = true;
                        this.errors.email.message = 'The email must be a valid email address.'
                        this.errorsCounter++;
                    }else {
                        this.errors.email.show = false;
                        this.errors.email.message = ''
                        this.errorsCounter - 1;
                    }

                    if(!this.phoneNumber) {
                        this.errors.phoneNumber.show = true;
                        this.errors.phoneNumber.message = 'The phone number field is required.'
                        this.errorsCounter++;
                    }else if(!this.validatePhoneNumber(this.phoneNumber)){
                        this.errors.phoneNumber.show = true;
                        this.errors.phoneNumber.message = 'The phone number must be a valid phone number.'
                        this.errorsCounter++;
                    } else {
                        this.errors.phoneNumber.show = false;
                        this.errors.phoneNumber.message = ''
                        this.errorsCounter - 1;
                    }

                    if(!this.password) {
                        this.errors.password.show = true;
                        this.errors.password.message = 'The password field is required.'
                        this.errorsCounter++;
                    }else if(this.password.length < 8) {
                        this.errors.password.show = true;
                        this.errors.password.message = 'The password must be at least 8 characters.'
                        this.errorsCounter++;
                    } else if(this.password !== this.confirmPassword) {
                        this.errors.confirmPassword.show = true;
                        this.errors.confirmPassword.message = 'The password confirmation does not match.'
                        this.errorsCounter++;
                    } else {
                        this.errors.password.show = false;
                        this.errors.password.message = ''
                        this.errorsCounter - 1;
                    }

                    if(!this.confirmPassword) {
                        this.errors.confirmPassword.show = true;
                        this.errors.confirmPassword.message = 'The password field is required.'
                        this.errorsCounter++;
                    }else if(this.confirmPassword.length < 8) {
                        this.errors.password.show = true;
                        this.errors.password.message = 'The password must be at least 8 characters.'
                        this.errorsCounter++;
                    } else if (this.password !== this.confirmPassword) {
                        this.errors.password.show = true;
                        this.errors.password.message = 'The password confirmation does not match.'
                        this.errorsCounter++;
                    } else {
                        this.errors.confirmPassword.show = false;
                        this.errors.confirmPassword.message = ''
                        this.errorsCounter - 1;
                    }


                    if(this.errorsCounter === 0) {
                        this.errorsCounter = 0;
                        return true;
                    }

                    this.errorsCounter = 0; 

                    event.preventDefault();   
                               
                },

                validEmail(email) {
                    let re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(email);
                },

                validatePhoneNumber(phoneNumber) {
                    let re = /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/;
                    return re.test(phoneNumber);
                }

            }
        })
    </script>
@endpush