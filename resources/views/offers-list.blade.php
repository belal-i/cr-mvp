@extends ('layouts/site')
@section ('content')
<br>
<div class="row site-content">
    <div>
        {{ $offers->links('pagination::bootstrap-4') }}
    </div>
</div>
<form class="row form-inline site-content" id="offer-filter-form">
    <div class="col">
        {{--TODO:
            See Redmine #1246.
            This needs to be rewritten to not use table anymore.
        --}}
        <table>
            <tr class="border-row">
                <td>Mietobjekt:</td>
                <td>
                    <?php
                        echo make_select_html(
                            'apartment_type',
                            [
                                'APARTMENT' => 'Wohnung',
                                'HOUSE'     => 'Haus',
                            ],
                            $filterParams['apartment_type'] ?? null,
                            [
                                'offer-filter-form-wide-elem',
                                'w-100',
                            ]
                        );
                    ?>
                </td>
                <td></td>
                <td>
                    <?php
                        echo make_select_html(
                            'size_sq_m',
                            [
                                ''   => 'Größe(m<sup>2</sup>) mind.',
                                '20' => '20m<sup>2</sup>',
                                '30' => '30m<sup>2</sup>',
                                '50' => '50m<sup>2</sup>',
                            ],
                            $filterParams['size_sq_m'] ?? null,
                            [
                                'offer-filter-form-wide-elem-plus',
                                'w-100',
                            ]
                        );
                    ?>
                </td>
            </tr>
            <tr class="border-row">
                <td>Zimmer:</td>
                <td>
                    <?php
                        echo make_select_html(
                            'number_of_rooms-min',
                            [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                                '7' => '7',
                            ],
                            $filterParams['number_of_rooms-min'] ?? null,
                            [
                                'offer-filter-form-wide-elem',
                                'w-100',
                            ]
                        );
                    ?>
                </td>
                <td class="not-mobile">bis&emsp;</td>
                <td class="not-mobile">
                    <?php
                        echo make_select_html(
                            'number_of_rooms-max',
                            [
                                ''  => 'maximal',
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                                '7' => '7',
                                '8' => '8',
                            ],
                            $filterParams['number_of_rooms-max'] ?? null,
                            [
                                'offer-filter-form-wide-elem-plus',
                                'w-100',
                            ]
                        );
                    ?>
                </td>
            </tr>
            <tr class="border-row">
                <td>Miete (Euro):</td>
                <td class="not-mobile">
                    <input type="text" name="rent-min" class="offer-filter-form-wide-elem w-100" value="<?php echo $filterParams['rent-min'] ?? ''; ?>">
                </td>
                <td class="not-mobile">bis&emsp;</td>
                <td>
                    <input type="text" name="rent-max" placeholder="max." class="offer-filter-form-wide-elem-plus w-100" value="<?php echo $filterParams['rent-max'] ?? ''; ?>">
                </td>
            </tr>
            <tr class="border-row">
                <td>Personen:</td>
                <td>
                    <?php
                        echo make_select_html(
                            'number_of_persons',
                            [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                            ],
                            $filterParams['number_of_persons'] ?? null,
                            [
                                'offer-filter-form-wide-elem',
                                'w-100',
                            ]
                        );
                    ?>
                </td>
                <td class="not-mobile"></td>
                <td class="not-mobile">
                    <?php
                        echo make_select_html(
                            'number_of_bedrooms',
                            [
                                '1' => '1 Schlafraum',
                                '2' => '2 Schlafräume',
                                '3' => '3 Schlafräume',
                                '4' => '4 Schlafräume',
                                '5' => '5 Schlafräume',
                                '6' => '6 Schlafräume',
                                '7' => '7 Schlafräume',
                                '8' => '8 Schlafräume',
                            ],
                            $filterParams['number_of_bedrooms'] ?? null,
                            [
                                'offer-filter-form-wide-elem-plus',
                                'w-100',
                            ]
                        );
                    ?>
                </td>
            </tr>
            <tr class="border-row">
                <td>Mietzeit:</td>
                <td>
                <input type="date" name="start_date-ui" placeholder="frei ab" class="offer-filter-form-wide-elem w-100" value="<?php echo $filterParams['start_date'] ?? ''; ?>">
                </td>
                <td></td>
                <td class="not-mobile">
                    <?php
                        echo make_select_html(
                            'min_months',
                            [
                                ''  => 'max. Mietzeit',
                                '1'  => 'max. 1 Monat',
                                '2'  => 'max. 2 Monate',
                                '3'  => 'max. 3 Monate',
                                '6'  => 'max. 6 Monate',
                                '12' => 'max. 12 Monate',
                            ],
                            $filterParams['min_months'] ?? null,
                            [
                                'offer-filter-form-wide-elem-plus',
                                'w-100',
                            ]
                        );
                    ?>
                </td>
            </tr>
            <tr class="border-row">
                <td>Lage:</td>
                <td>
                    <?php
                        echo make_select_html(
                            'neighborhood',
                            [
                                'Frankfurt u. Umgebung'  => 'Frankfurt u. Umgebung',
                                'Frankfurt-Stadt'  => 'Frankfurt-Stadt',
                                'Frankfurt-Innenstadt'  => 'Frankfurt-Innenstadt',
                                'Offenbach u. Umgebung'  => 'Offenbach u. Umgebung',
                                'Vordertaunus' => 'Vordertaunus',
                            ],
                            $filterParams['neighborhood'] ?? null,
                            [
                                'offer-filter-form-wide-elem',
                                'w-100',
                            ]
                        );
                    ?>
                </td>
                <td></td>
                {{--
                <td>
                    <a href="#" onclick="alert('TODO: Stadttteilauswahl');">Stadtteile auswählen</a>
                </td>
                --}}
            </tr>
        </table>
    </div><!-- .col -->
    <div class="col">
        <table>
            <tr class="border-row">
                <td>
                    <?php echo make_checkbox(
                        'washing_machine',
                        'Waschmaschine',
                        isset($filterParams['washing_machine'])
                    );
                    ?>
                </td>
                <td>
                    <input type="button" value="Alles zurücksetzten" onclick="window.location.href = '/offers';">
                </td>
            </tr>
            <tr class="border-row">
                <td class="not-mobile">
                    <?php echo make_checkbox(
                        'washing_machine_in_apartment',
                        'Waschmaschine in der Wohnung',
                        isset($filterParams['washing_machine_in_apartment'])
                    );
                    ?>
                </td>
                <td>
                    <?php echo make_checkbox(
                        'has_parking_space',
                        'PKW-Stellplatz',
                        isset($filterParams['has_parking_space'])
                    );
                    ?>
                </td>
            </tr>
            <tr>
                <td class="not-mobile">
                    <?php echo make_checkbox(
                        'dryer',
                        'Trockner',
                        isset($filterParams['dryer'])
                    );
                    ?>
                </td>
                <td>
                    <?php echo make_checkbox(
                        'has_balcony',
                        'Balkon, Terrasse',
                        isset($filterParams['has_balcony'])
                    );
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo make_checkbox(
                        'has_dish_washer',
                        'Spülmaschine',
                        isset($filterParams['has_dish_washer'])
                    );
                    ?>
                </td>
                <td class="not-mobile">
                    <input id="has_elevator" name="has_elevator" type="checkbox"<?php echo isset($filterParams['has_elevator']) ? ' checked' : ''; ?>> ab <input type="number" name="elevator-cutoff-story" style="max-width: 40px;">
                    <label for="elevator">Etage nur mit Lift</label>
                </td>
            </tr>
            <tr>
                <td class="not-mobile">
                    <?php echo make_checkbox(
                        'pets_ok',
                        'Haustiere erlaubt',
                        isset($filterParams['pets_ok'])
                    );
                    ?>
                </td>
                <td>
                    <?php echo make_checkbox(
                        'has_internet',
                        'Internet',
                        isset($filterParams['has_internet'])
                    );
                    ?>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr class="border-row">
                <td></td>
                <td>
                    <input type="submit" id="offer-filter-submit" class="cr-submit-button no-radius" value="Ergebnisse anzeigen">
                    <strong id="offer-filter-number-results" class="pe-2 pt-1">{{ $offerCount }}</strong>
                </td>
            </tr>
        </table>
    </div><!-- .col -->
</form><!-- .row -->

<br>
<div class="row site-content" style="border-bottom: 1px solid black; padding-bottom: 3px;">
    <div class="not-mobile col-sm-auto cr-ui-tab-1">Ergebnisliste</div>
    <div class="col-7"></div>
    <div class="col-sm-auto">
        Sortierung:
        <?php echo make_select_html(
            'offers-order-by',
            [
                'date_published'            => 'Neuste zuerst',
                'start_date'                => 'frei ab',
                'rent-ASC'                  => 'Preis - niedrigster zuerst',
                'rent-DESC'                 => 'Preis - höchster zuerst',
                'apartments.size_sq_m-ASC'  => 'Wohnfläche - kleinste zuerst',
                'apartments.size_sq_m-DESC' => 'Wohnfläche - größte zuerst',
            ],
            null,
            ['no-radius'],
            'offers-order-by'
        ); ?>
    </div>
</div>

<div id="list-view-elements">
<?php
$css_toggle_suffix_int = 1;
$splide_count = 0;
?>
@foreach ($offers as $offer)
    <?php
    $css_toggle_suffix_int *= -1;
    $css_toggle_suffix = (string)$css_toggle_suffix_int;
    ?>
    <div class="row site-content offer-list-view-entry offer-list-view-entry-toggle-{{ $css_toggle_suffix }}">
        <div class="col-sm-12 col-md-4 ps-0">
            <?php
                echo $offer->apartment->makeImageSlideshow(
                    sprintf('splide-%s', $splide_count),
                    ['splide'],
                    ['list-view-image']
                );
                $splide_count++;
            ?>
        </div>
        <div class="col-sm-12 col-md-7" onclick="window.location.href = '/offers/{{ $offer->id }}';">
            <h4 class="not-mobile"><strong>{{ $offer->apartment->title }}</strong></h4>
            <?php
            $subway_stations = $offer->apartment
                                     ->house
                                     ->address
                                     ->getSubwayStationsAsList();

            $neighborhood = $offer->apartment->house->address->neighborhood;
            $neighborhood_text = !empty($neighborhood)
                ? ', ' . $neighborhood
                : '';

            ?>

            <p>{{ $offer->apartment->getNumberOfRoomsText() }}, {{ $offer->apartment->size_sq_m }}m<sup>2</sup>{{ $neighborhood_text }}, {{ $offer->apartment->house->address->street }}</p>
            @foreach ($subway_stations as $station)
                <p class="not-mobile">{{ $station }}</p>
            @endforeach

            <div class="not-mobile" style="text-align:right; width:100%;">
            <span style="float:left;"><strong>frei ab {{ $offer->getStartText() }}</strong>, {{ $offer->getMaxMonthsText() }}, Mindestmietzeit {{ $offer->min_months }} Monate</span>Miete pro Monat: <strong>{{ get_euro_text($offer->rent) }}</strong>
            <div>{!! $offer->apartment->getRatingStarsImg(75) !!}</div>
            </div>
            <span class="mobile-only">frei ab {{ $offer->getStartText() }} - <strong>Miete pro Monat: {{ get_euro_text($offer->rent) }}</strong></span>
        </div>
    </div><!-- .row -->
@endforeach
</div>

<script>
    mountSplides({{ $splide_count }});
</script>
@endsection
