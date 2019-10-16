<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Let's Event</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body id="homepage">
        <header class="homepageInformation">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 text-center">
                        <h1 class="display-4">Let's Event</h1>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('dashboard') }}" class="btn btn-dark mx-3">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary mx-3">Aanmelden</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-secondary mx-3">Registreren</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </header>
    </body>
</html>
