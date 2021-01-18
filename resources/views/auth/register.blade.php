@extends('layouts.app')

@section('content')
<div class="view">
    <div class="view__content view__content--center">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1>Register</h1>
            <div class="form-group">
                <label for="first_name" class="form-label">First name</label>
            
                <input id="first_name" type="text" class="form-input  name="first_name" value="{{ old('first_name') }}" >

                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
    
            </div>

            <div class="form-group row">
                <label for="name" class="form-label">Name</label>

                <input id="name" type="text" class="form-input" name="name" value="{{ old('name') }}">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>

                <input id="email" type="email" class="form-input " name="email" value="{{ old('email') }}">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number" class="form-label">Phone number</label>

                <div class="col-md-6">
                    <input id="phone_number" type="text" class="form-input @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}">

                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-input" name="password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="form-label">Confirm password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-input" name="password_confirmation">
                </div>
            </div>

            <div class="form-action">
                <button type="submit" class="button button-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection