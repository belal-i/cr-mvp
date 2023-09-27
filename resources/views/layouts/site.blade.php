<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
        <title>Wohnen auf Zeit Frankfurt: 60 Wohnungen und Apartments : Möblierte Wohnungen und Apartments</title>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="/">
                        <img src="{{ asset('images/city-residence-logo.svg') }}" id="logo-image">
                    </a>
                </div>
                <div class="col">
                    <span id="l10n-flags">
                        <a href="/">
                            <img src="{{ asset('images/de.gif') }}">
                        </a>
                        <a href="/">
                            <img src="{{ asset('images/en.gif') }}">
                        </a>
                        <a href="/">
                            <img src="{{ asset('images/fr.gif') }}">
                        </a>
                        <a href="/">
                            <img src="{{ asset('images/es.gif') }}">
                        </a>
                        <a href="/">
                            <img src="{{ asset('images/it.gif') }}">
                        </a>
                    </span>
                </div>
                <div class="col" id="quicksearch">
                    {{-- TODO --}}
                    <form action="/" method="get">
                        <input type="text" placeholder="Objekt-Nr. oder Straße">
                        <input type="submit" value="          " class="triangle-submit">
                    </form>
                </div>
            </div>
            <div class="row">
                {{-- TODO: Unsetting .navbar --bs-navbar-padding-x: 0; 
                    in browser dev tools, made the menu look thinner,
                    more like on actual homepage.
                --}}
                <nav class="navbar navbar-dark cr-bg-dark navbar-expand-lg">
                    <div class="container">
                        <div class="row navbar-nav mr-auto nav-fill w-100">
                            <div class="col">
                                <a class="nav-link" href="/">Suchen</a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="/">Mieter-Info</a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="/">Anbieten</a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="/">Vermieter-Info</a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="/">Möblierungsservice</a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="/">Über uns</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            @yield ('content')
        </div>
    </body>
</html>
