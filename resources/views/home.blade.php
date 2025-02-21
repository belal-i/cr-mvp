@extends ('layouts/site')
@section ('content')
<div class="row">
    <div class="col" id="homepage-cover-image">
        <div class="container">
            <form action="/offers" method="get" class="row form-inline" id="quickfilter-form">
                <div class="col-3"></div>
                <div class="col-sm-auto quickfilter-form-elem quickfilter-form-label">
                {{ __('Zimmer') }}
                </div>
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
                        ['no-radius', 'col-sm-auto'],
                        'quickfilter-nr-rooms'
                    );
                ?>
                </div>

                <div class="col-sm-auto quickfilter-form-elem quickfilter-form-label">
                {{ __('Miete (max.)') }}
                </div>
                <div class="col-sm-auto quickfilter-form-elem quickfilter-elem-with-line">
                <input class="form-control no-radius" type="text" id="quickfilter-rent"
                    name="rent-max" placeholder="EUR">
                </div>

                <div class="col-sm-auto quickfilter-form-elem quickfilter-form-label">
                {{ __('ab') }}
                </div>
                <div class="col-sm-auto quickfilter-form-elem">
                <?php
                    echo make_select_html(
                        'start_date-ui',
                        get_current_months(5),
                        null,
                        ['no-radius'],
                        'quickfilter-start-month'
                    );
                ?>
                </div>

                <div id="quickfilter-submit-button"
                    class="col-sm-auto quickfilter-form-elem quickfilter-form-label"
                    onclick="$('#quickfilter-form').submit();">
                    {{ $offerCount }} {{ __('Angebote zeigen') }}
                </div>

                <div class="col-2"></div>
            </form>
        </div><!-- .container -->
    </div><!-- .col -->
</div><!-- .row -->

<div class="row site-content">
    <div class="col homepage-container">
        <h3 class="homepage-banner">{!! $bannerText !!}</h3>
        <br>
        {!! $contentText !!}
    </div>
</div>
@endsection
