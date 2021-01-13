@extends('layouts.app')

@section('content')

    <div class="view">
        @include('includes.user-account-nav')
        <div class="view__content">
            <div class="view__header">
                My Account
            </div>
            <form class="account_details" method="POST" action="{{ route('client-user.update') }}">
                @METHOD('PATCH')
                @csrf
    
                <div class="input__group">
                    <div class="input__container">
                        <label for="first-name">First name</label>
                        <input type="text" id="first-name" name="first_name" value="{{$user->first_name}}"/>
                    </div>
                    <div class="input__container">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{$user->name}}"/>
                    </div>
                </div>
                <div class="input__group">
                    <div class="input__container">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="{{$user->email}}"/>
                    </div>
                    <div class="input__container">
                        <label for="phone-number">Phone number</label>
                        <input type="text" id="phone-number" name="phone_number" value="{{$user->phone_number}}"/>
                    </div>
                </div>
                <div class="input__group">
                    <div class="input__container">
                        <label for="current-password">Current password</label>
                        <input type="text" id="current-password" name="current_password"/>
                    </div>
                    <div class="input__container">
                        <label for="password">Password</label>
                        <input type="text" id="password" name="password"/>
                    </div>
                    <div class="input__container">
                        <label for="password-confirm">Confirm Password</label>
                        <input type="text" id="password-confirm" name="password_confirmation"/>
                    </div>
                </div>
                <div class="action__container">
                    <button type="submit">Save</button>
                </div>
            </form>
        </div>
        
    </div>

@endsection