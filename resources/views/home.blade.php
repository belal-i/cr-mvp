@extends ('layouts/site')
@section ('content')
<div class="row">
    <div class="col" id="homepage-cover-image">
        <div id="quickfilter-container" class="container">
            <form action="/offers" method="get" class="row form-inline" id="quickfilter-form">
                <div class="col-2"></div>

                <div class="col-sm-auto quickfilter-form-elem quickfilter-form-label">Zimmer</div>
                <div class="col-sm-auto quickfilter-form-elem quickfilter-elem-with-line">
                <?php
                    echo make_select_html(
                        'number_of_rooms-min',
                        [
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                        ],
                        null,
                        ['no-radius'],
                        'quickfilter-nr-rooms'
                    );
                ?>
                </div>

                <div class="col-md-auto quickfilter-form-elem quickfilter-form-label">Miete (max.)</div>
                <div class="col quickfilter-form-elem quickfilter-elem-with-line">
                    <input class="form-control no-radius" type="text" id="quickfilter-rent" name="rent-max" placeholder="EUR">
                </div>

                <div class="col-sm-auto quickfilter-form-elem quickfilter-form-label">ab</div>
                <div class="col quickfilter-form-elem">
                <?php
                    echo make_select_html(
                        'start_date',
                        get_current_months(4),
                        null,
                        ['no-radius'],
                        'quickfilter-start-month'
                    );
                ?>
                </div>

                <div id="quickfilter-submit-button" class="col-3 quickfilter-form-elem quickfilter-form-label" onclick="$('#quickfilter-form').submit();">
                    {{ $offerCount }} Angebote zeigen
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
