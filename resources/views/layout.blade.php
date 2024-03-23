
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Parcel Pirate - @yield('title')</title>
        @include('partials.css')
    </head>
    <body>
        <div class="header">
            <img src="/parcelpirate.png" alt="Logo" class="logo">
            <div class="title-and-nav">
                <div class="site-title">Parcel Pirate</div>
                @include('partials.mainmenu')
            </div>
        </div>
        <h2>@yield('title')</h2>

        @yield('content')

    </body>
</html>


