@extends('layout')

@section('title', 'Edit Profile')

@section('content')

        <div class="status-section">
            <div class="custom-form-container">
                    @include('profile.partials.update-profile-information-form')
            </div>
        </div>
        <div class="status-section">
            <div class="custom-form-container">
                    @include('profile.partials.update-password-form')
            </div>
        </div>
        <div class="status-section">
            <div class="custom-form-container">
                    @include('profile.partials.delete-user-form')
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.0/dist/alpine.js" defer></script>

@endsection
