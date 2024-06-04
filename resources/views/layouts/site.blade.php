<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php
        $version = config('app.version');
        $cssPath = 'css' . $version;
        $jsPath  = 'js'  . $version;
        ?>
        <link href="{{ asset($cssPath . '/app.css') }}" rel="stylesheet">
        <link href="{{ asset($cssPath . '/style.css') }}" rel="stylesheet">
        <link href="{{ asset($cssPath . '/splide.css') }}" rel="stylesheet">

        <script src="{{ asset($jsPath . '/app.js') }}"></script>
        <script src="{{ asset($jsPath . '/splide.js') }}"></script>

        {{-- TODO: Figure out some way to get the $offerCount into 
            EVERY view, so that we can set this dynamically as well.
        --}}
        <title>Wohnen auf Zeit Frankfurt: 60 Wohnungen und Apartments : Möblierte Wohnungen und Apartments</title>
        <link href="{{ asset('images/favicon.ico') }}" rel="shortcut icon">

    </head>
    <body>
        <div class="container">
            <div class="row" id="site-header-row">
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
            <div class="row" id="top-navbar-row">
                {{-- TODO: Unsetting .navbar --bs-navbar-padding-x: 0; 
                    in browser dev tools, made the menu look thinner,
                    more like on actual homepage.
                --}}
                <nav class="navbar navbar-dark cr-bg-dark navbar-expand-lg">
                    <div class="container">
                        <div class="row navbar-nav mr-auto nav-fill w-100">
                            <div class="col">
                                <a class="nav-link" href="/offers">Suchen</a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="/renter-info">Mieter-Info</a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="/make-offer">Anbieten</a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="/landlord-info">Vermieter-Info</a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="/interior-design">Möblierungsservice</a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="/about">Über uns</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            @yield ('content')

            <div id="bottom-nav-row" class="row cr-bg-dark cr-txt-light">
                <div class="col">
                    <h4>Mieter-Info</h4>
                    <ul>
                        <li><a class="nav-link" href="/">Listenelement 1</a></li>
                        <li><a class="nav-link" href="/">Listenelement 2</a></li>
                        <li><a class="nav-link" href="/">Listenelement 3</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h4>Vermieter-Info</h4>
                    <ul>
                        <li><a class="nav-link" href="/">Listenelement 1</a></li>
                        <li><a class="nav-link" href="/">Listenelement 2</a></li>
                        <li><a class="nav-link" href="/">Listenelement 3</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h4>Stadtinfos</h4>
                    <ul>
                        <li><a class="nav-link" href="/">Listenelement 1</a></li>
                        <li><a class="nav-link" href="/">Listenelement 2</a></li>
                        <li><a class="nav-link" href="/">Listenelement 3</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h4>Über uns</h4>
                    <ul>
                        <li><a class="nav-link" href="/">Listenelement 1</a></li>
                        <li><a class="nav-link" href="/">Listenelement 2</a></li>
                        <li><a class="nav-link" href="/">Listenelement 3</a></li>
                    </ul>
                </div>
            </div>
        </div><!-- .container -->
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
