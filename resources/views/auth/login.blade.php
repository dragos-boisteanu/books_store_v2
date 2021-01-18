@extends('layouts.app')

@section('content')
<div class="view">
    <div class="view__content view__content--center">
       
        <form method="POST" action="{{ route('login') }}">
            @csrf
    
            <h1>Login</h1>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>

                <input id="email" type="email" class="form-input" name="email" value="{{ old('email') }}" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
    
                <div class="">
                    <input id="password" type="password" class="form-input" name="password">
    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
    
            <div class="">
                <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                <label class="form-label" for="remember">
                    Remember me
                </label>
            </div>
    
            <div class="form-action">
                <button type="submit" class="button button-primary">
                    Login
                </button>
    
                <div class="links">
                    <div>
                        @if (Route::has('password.request'))
                            <a class="link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        @endif
                    </div>
                    <div>
                        <a class="link" href="{{ route('register') }}">
                            Not a member ? Register here ! 
                        </a>
                    </div>
                </div>
            </div>
        </form>    
    </div>
</div>
@endsection
