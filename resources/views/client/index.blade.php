@extends('layouts.app')

@section('content')

    <div class="view">
        @include('includes.user-account-nav')
        <div class="view__content">
            <h1 class="view__header">
                My Account
            </h1>
            <form class="account_details" method="POST" action="{{ route('client-user.update') }}">
                @METHOD('PATCH')
                @csrf
    
                <div class="form-section">
                    <div class="form-group">
                        <label for="first-name" class="form-label">First name</label>
                        <input type="text" id="first-name" name="first_name" class="form-input" value="{{$user->first_name}}"/>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-input" value="{{$user->name}}"/>
                    </div>
                </div>
                
                <div class="form-section">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email" class="form-input" class="form-input" value="{{$user->email}}"/>
                    </div>
                    <div class="form-group">
                        <label for="phone-number" class="form-label">Phone number</label>
                        <input type="text" id="phone-number" name="phone_number" class="form-input" value="{{$user->phone_number}}"/>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="current-password" class="form-label">Current password</label>
                        <input type="text" id="current-password" class="form-input" name="current_password"/>
                    </div>
                <div class="form-section">
                    <div class="form-group">
                        <label for="password"
                        class="form-label">Password</label>
                        <input type="text" id="password" name="password" class="form-input"/>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <input type="text" id="password-confirm" name="password_confirmation" class="form-input"/>
                    </div>
                </div>
                <div class="form-section">
                    <button type="submit" class="button button-primary">Save</button>
                </div>
            </form>
        </div>
        
    </div>

@endsection