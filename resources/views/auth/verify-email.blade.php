@extends('layout')

@section('title', 'Verify Email')

@section('content')
<div class="custom-form-container">
    <div class="status-section">
        <div class="status-title">Verify Your Email Address</div>
        <p class="mb-4">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </p>
        
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-green-600">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="form-button">{{ __('Resend Verification Email') }}</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="form-button" style="background-color: transparent; color: #E5BE01; text-decoration: underline;">{{ __('Log Out') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
