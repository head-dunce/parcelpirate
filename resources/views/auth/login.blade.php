@extends('layout')

@section('title', 'Login')

@section('content')
<div class="custom-form-container">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="status-section">
            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-group">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Submit Button & Links -->
            <div class="form-group" style="text-align: right;">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="btn btn-link" style="background-color: transparent; color: #E5BE01; text-decoration: underline; margin-right: 10px;">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
                <input type="submit" value="Login" class="form-button">
            </div>
        </div>
    </form>

    <div style="text-align: center; margin-top: 20px;">
        <!-- Register -->
        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="form-button" style="background-color: transparent; color: #E5BE01; text-decoration: underline;">
            {{ __('Register') }}
        </a>
        @endif
    </div>
</div>
@endsection
