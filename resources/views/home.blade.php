@extends ('layouts/site')
@section ('content')
<div class="row">
    <div class="col" id="homepage-cover-image">
        <div id="quickfilter-container" class="container">
            <form class="row form-inline" id="quickfilter-form">
                <div class="col-2"></div>

                <div class="col-sm-auto quickfilter-form-elem quickfilter-form-label">Zimmer</div>
                <div class="col-sm-auto quickfilter-form-elem quickfilter-elem-with-line">
                    <select class="no-radius" id="quickfilter-nr-rooms">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>

                <div class="col-md-auto quickfilter-form-elem quickfilter-form-label">Miete (max.)</div>
                <div class="col quickfilter-form-elem quickfilter-elem-with-line">
                    <input class="form-control no-radius" type="text" id="quickfilter-rent" placeholder="EUR">
                </div>

                <div class="col-sm-auto quickfilter-form-elem quickfilter-form-label">ab</div>
                <div class="col quickfilter-form-elem">
                    <select class="no-radius" id="quickfilter-start-month">
                        <option>sofort</option>
                        <option>Oktober</option>
                        <option>November</option>
                        <option>Dezember</option>
                        <option>später</option>
                    </select>
                </div>

                <div id="quickfilter-submit-button" class="col-3 quickfilter-form-elem quickfilter-form-label" onclick="window.location.href = '/offers';">
                    101 Angebote zeigen
                </div>

                <div class="col-2"></div>
            </form>
        </div><!-- .container -->
    </div><!-- .col -->
</div><!-- .row -->

<div class="row site-content">
    <div class="col homepage-content">
        <h3>Wohnen auf Zeit - Möblierte Wohnungen in besten Lagen</h3>
        <br>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
</div>
@endsection
