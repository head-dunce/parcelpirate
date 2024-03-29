@extends('layout')

@section('title', 'Register')

@section('content')
<div class="custom-form-container">
    <form method="POST" action="{{ route('register') }}" class="form" style="margin-top: 20px;">
        @csrf
        <div class="status-section">
            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus class="form-control">
                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-control">
                @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" required class="form-control">
                @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control">
                @error('password_confirmation')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="text-align: right;">
                <a href="{{ route('login') }}" class="form-button" style="background-color: transparent; color: #E5BE01; text-decoration: underline;">Already registered?</a>
                <button type="submit" class="form-button">Register</button>
            </div>
        </div>
    </form>
</div>
@endsection
