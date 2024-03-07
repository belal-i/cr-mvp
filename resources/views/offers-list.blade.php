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
        <table>
            <tr class="border-row">
                <td>Mietobjekt:</td>
                <td colspan=2>
                    <select name="apartment_type" class="offer-filter-form-wide-elem">
                        <option value="APARTMENT">Wohnung</option>
                        <option value="HOUSE">Haus</option>
                    </select>
                </td>
                <td>
                    <select name="size_sq_m" class="offer-filter-form-wide-elem-plus">
                        <option value="">Größe(m<sup>2</sup>) mind.</option>
                        <option value="20">20m<sup>2</sup></option>
                        <option value="30">30m<sup>2</sup></option>
                        <option value="50">50m<sup>2</sup></option>
                    </select>
                </td>
            </tr>
            <tr class="border-row">
                <td>Zimmer:</td>
                <td>
                    <select name="number_of_rooms-min" class="offer-filter-form-wide-elem">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                    </select>
                </td>
                <td>bis</td>
                <td>
                    <select name="number_of_rooms-max" class="offer-filter-form-wide-elem-plus">
                        <option value="">maximal</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                    </select>
                </td>
            </tr>
            <tr class="border-row">
                <td>Miete (Euro):</td>
                <td>
                    <input type="text" name="rent-min" class="offer-filter-form-wide-elem">
                </td>
                <td>bis</td>
                <td>
                    <input type="text" name="rent-max" placeholder="max." class="offer-filter-form-wide-elem-plus">
                </td>
            </tr>
            <tr class="border-row">
                <td>Personen:</td>
                <td colspan=2>
                    <select name="number_of_persons" class="offer-filter-form-wide-elem">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </td>
                <td>
                    {{-- TODO: cr-legacy-to-json currently does not supply
                        data for this field.
                    --}}
                    <select name="number_of_bedrooms" class="offer-filter-form-wide-elem-plus">
                        <option value="1">1 Schlaufraum</option>
                        <option value="2">2 Schlaufräume</option>
                        <option value="3">3 Schlaufräume</option>
                        <option value="4">4 Schlaufräume</option>
                        <option value="5">5 Schlaufräume</option>
                        <option value="6">6 Schlaufräume</option>
                        <option value="7">7 Schlaufräume</option>
                        <option value="8">8 Schlaufräume</option>
                    </select>
                </td>
            </tr>
            <tr class="border-row">
                <td>Mietzeit:</td>
                <td colspan=2>
                    <input type="text" name="start_date" placeholder="frei ab" onclick="alert('TODO: Kalendarauswahl, Ticket #962.');" class="offer-filter-form-wide-elem">
                </td>
                <td>
                    <select name="min_months" class="offer-filter-form-wide-elem-plus">
                        <option value="">Mindestmietdauer</option>
                        <option value="1">1 Monat</option>
                        <option value="2">2 Monate</option>
                        <option value="3">3 Monate</option>
                        <option value="6">6 Monate</option>
                        <option value="12">12 Monate</option>
                    </select>
                </td>
            </tr>
            <tr class="border-row">
                <td>Lage:</td>
                <td colspan=2>
                    <select name="neighborhood" class="offer-filter-form-wide-elem">
                        <option>Frankfurt u. Umgebung</option>
                        <option>Frankfurt-Stadt</option>
                        <option>Frankfurt-Innenstadt</option>
                        <option>Offenbach u. Umgebung</option>
                        <option>Vordertaunus</option>
                    </select>
                </td>
                <td>
                    <a href="#" onclick="alert('TODO: Stadttteilauswahl');">Stadtteile auswählen</a>
                </td>
            </tr>
        </table>
    </div><!-- .col -->
    <div class="col">
        <table>
            <tr class="border-row">
                <td>
                    Kategorie:
                    <select style="min-width: 100px;" name="rating">
                        <option value="1.0">*</option>
                        <option value="2.0">**</option>
                        <option value="3.0">***</option>
                        <option value="4.0">****</option>
                        <option value="5.0">*****</option>
                    </select>
                </td>
                <td>
                    <input type="button" value="Alles zurücksetzten">
                </td>
            </tr>
            <tr class="border-row">
                <td>
                    <input type="checkbox"> Waschmaschine
                </td>
                <td>
                    <input type="checkbox"> PKW-Stellplatz
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox"> Waschmaschine in der Wohnung
                </td>
                <td>
                    <input type="checkbox"> Balkon, Terrasse
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox"> Trockner
                </td>
                <td>
                    <input type="checkbox"> ab <input type="number" style="max-width: 40px;"> Etage nur mit Lift
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox"> Spülmaschine
                </td>
                <td>
                    <input type="checkbox"> Internet
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <input type="checkbox"> Haustiere erlaubt
                </td>
            </tr>
            <tr class="border-row">
                <td>
                    U-/S-Bahn
                    <select name="nearby_public_transit">
                        <option>--</option>
                        <option>U1</option>
                        <option>U2</option>
                        <option>...</option>
                        <option>S1</option>
                        <option>S2</option>
                        <option>...</option>
                        <option>T1</option>
                        <option>T2</option>
                        <option>...</option>
                    </select>
                    <br>(<a href="#">Netzplan</a>)
                </td>
                <td>
                    <input type="submit" class="cr-submit-button no-radius" value="{{ $offerCount }} Ergebnisse anzeigen">
                </td>
            </tr>
        </table>
    </div><!-- .col -->
</form><!-- .row -->

<br>
<div class="row site-content" style="border-bottom: 1px solid black; padding-bottom: 3px;">
    <div class="col-sm-auto cr-ui-tab-1">Ergebnisliste</div>
    <div class="col-7"></div>
    <div class="col-sm-auto">
        Sortierung: <select class="no-radius">
            <option>frei ab</option>
            <option>Kategorie</option>
            <option>Preis - niedrigster zuerst</option>
            <option>Preis - höchster zuerst</option>
            <option>Wohnfläche</option>
            <option>Lage</option>
        </select>
        {{-- TODO: Ascending and descending. --}}
    </div>
</div>

<?php
$css_toggle_suffix_int = 1;
?>
@foreach ($offers as $offer)
    <?php
    $css_toggle_suffix_int *= -1;
    $css_toggle_suffix = (string)$css_toggle_suffix_int;
    ?>
    <a href="/offers/{{ $offer->id }}" class="row site-content offer-list-view-entry offer-list-view-entry-toggle-{{ $css_toggle_suffix }}">
        <div class="col-4">
            <img src="images/pexels-vecislavas-popa-1571463.jpg" width="300" height="200">
        </div>
        <div class="col-7">
            <h4><strong>{{ $offer->apartment->title }}</strong></h4>
            <?php
            if ($offer->apartment->apartment_type == 'HOUSE') {
                $nr_of_rooms_text = 'Haus mit ' . $offer->apartment->number_of_rooms . 'Zimmern';
            } else {
                $nr_of_rooms_text = $offer->apartment->number_of_rooms . '-Zi. Wohnung';
            }

            $start_date_text = get_start_text_from_date($offer->start_date);

            if ($offer->max_months > 0) {
                $max_months_text = 'höchstens ' . $offer->max_months . ' Monate';
            } else {
                $max_months_text = 'für unbefristet';
            }

            $rent_text = get_euro_text($offer->rent);

            $subway_stations = json_decode(
                $offer->apartment
                      ->house
                      ->address
                      ->nearby_public_transit,
                  true
            );
            $subway_stations = $subway_stations["subway"] ?? [];
            $subway_stations = array_keys($subway_stations);

            $neighborhood = $offer->apartment->house->address->neighborhood;
            $neighborhood_text = !empty($neighborhood)
                ? ', ' . $neighborhood
                : '';

            ?>

            <p>{{ $nr_of_rooms_text }}, {{ $offer->apartment->size_sq_m }}m<sup>2</sup>{{ $neighborhood_text }}, {{ $offer->apartment->house->address->street }}</p>
            @foreach ($subway_stations as $station)
                <p>{{ $station }}</p>
            @endforeach
            <div style="text-align:right; width:100%;">
            <span style="float:left;"><strong>frei ab {{ $start_date_text }}</strong>, {{ $max_months_text }}, Mindestmietzeit {{ $offer->min_months }} Monate</span>Miete pro Monat: <strong>{{ $rent_text }}</strong>
            </div>

        </div>
    </a><!-- .row -->
@endforeach
@endsection
