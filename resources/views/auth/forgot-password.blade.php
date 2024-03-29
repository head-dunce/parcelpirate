@extends('layout')

@section('title', 'Forgot Password')

@section('content')
<div class="custom-form-container">
    <div class="status-section">
        <div class="status-title">Forgot Your Password?</div>
        <p class="mb-4">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </p>
        
        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="text-align: right;">
                <button type="submit" class="form-button">{{ __('Email Password Reset Link') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
