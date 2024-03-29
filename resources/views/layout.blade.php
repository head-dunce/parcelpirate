
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Parcel Pirate - @yield('title')</title>
        @include('partials.css')
        <link rel="icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon/android-chrome-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('images/favicon/android-chrome-512x512.png') }}">
        <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    </head>
    <body>
        <div class="top-bar">
            <a href="https://www.parcelpirate.com" class="top-bar-logo">
                <img src="/parcelpirate.png" alt="Logo">
            </a>
            <div class="site-name"><a href="https://www.parcelpirate.com">Parcel Pirate</a></div>
            <button class="hamburger-menu">&#9776;</button>
        </div>
        <div class="container">
            <div class="header">
                <a href="https://www.parcelpirate.com"><img src="/parcelpirate.png" alt="Logo" class="logo"></a>
                <div class="title-and-nav">
                    <div class="site-title"><a href="https://www.parcelpirate.com">Parcel Pirate</a></div>
                    @include('partials.mainmenu')
                </div>
            </div>
            <h2>@yield('title')</h2>
            @guest
                <div class="account-login-prompt">
                <p><a href="/register">Create a free account and login to get started!</a></p>
                </div>
            @endguest
            @auth
                @if(!auth()->user()->hasVerifiedEmail())
                <div class="account-login-prompt">
                    <p>Please check your email for a verification link to activate your account. Click the link to get started!</p>
                </div>
                @endif
            @endauth

            @yield('content')

        </div>
        <footer class="site-footer">
            <div class="footer-content">
                <p>Established March 29, 2024 created by Jim Frey</p>
                <p>Email: captain@parcelpirate.com</p>
                <p><a href="https://www.facebook.com/parcelpirate">facebook.com/parcelpirate</a></p>
                <p>Other projects: <a href="https://www.weatherpirate.com">Weather Pirate</a> | <a href="https://www.carguygarage.com">Car Guy Garage</a></p>
            </div>
        </footer>
    </body>
</html>


