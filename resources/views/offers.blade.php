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
                    <select id="offer-type" name="offer-type" class="offer-filter-form-wide-elem">
                        <option>Wohnung</option>
                        <option>Haus</option>
                    </select>
                </td>
                <td>
                    <select id="size-sq-m" name="size-sq-m" class="offer-filter-form-wide-elem-plus">
                        <option>Größe(m<sup>2</sup>) mind.</option>
                        <option>20m<sup>2</sup></option>
                        <option>30m<sup>2</sup></option>
                        <option>50m<sup>2</sup></option>
                        <option>etc.</option>
                    </select>
                </td>
            </tr>
            <tr class="border-row">
                <td>Zimmer:</td>
                <td>
                    <select id="number-of-rooms-min" name="number-of-rooms-min" class="offer-filter-form-wide-elem">
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
                    <select id="number-of-rooms-max" name="number-of-rooms-max" class="offer-filter-form-wide-elem-plus">
                        <option>maximal</option>
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
                    <input type="text" id="min-rent" name="min-rent" class="offer-filter-form-wide-elem">
                </td>
                <td>bis</td>
                <td>
                    <input type="text" id="max-rent" name="max-rent" placeholder="max." class="offer-filter-form-wide-elem-plus">
                </td>
            </tr>
            <tr class="border-row">
                <td>Personen:</td>
                <td colspan=2>
                    <select id="number-of-persons" name="number-of-persons" class="offer-filter-form-wide-elem">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </td>
                <td>
                    <select id="number-of-rooms" name="number-of-rooms" class="offer-filter-form-wide-elem-plus">
                        <option>1 Schlaufraum</option>
                        <option>2 Schlaufräume</option>
                        <option>3 Schlaufräume</option>
                        <option>4 Schlaufräume</option>
                        <option>5 Schlaufräume</option>
                        <option>6 Schlaufräume</option>
                        <option>7 Schlaufräume</option>
                        <option>8 Schlaufräume</option>
                    </select>
                </td>
            </tr>
            <tr class="border-row">
                <td>Mietzeit:</td>
                <td colspan=2>
                    <input type="text" id="start-date" name="start-date" placeholder="frei ab" onclick="alert('TODO: Kalendarauswahl, Ticket #962.');" class="offer-filter-form-wide-elem">
                </td>
                <td>
                    <select id="min-months" name="min-months" class="offer-filter-form-wide-elem-plus">
                        <option>Mindestmietdauer</option>
                        <option>1 Monat</option>
                        <option>2 Monate</option>
                        <option>3 Monate</option>
                        <option>6 Monate</option>
                        <option>12 Monate</option>
                    </select>
                </td>
            </tr>
            <tr class="border-row">
                <td>Lage:</td>
                <td colspan=2>
                    <select id="neighborhood" name="neighborhood" class="offer-filter-form-wide-elem">
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
                    <select style="min-width: 100px;" id="star-rating" name="star-rating">
                        <option>*</option>
                        <option>**</option>
                        <option>***</option>
                        <option>****</option>
                        <option>*****</option>
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
                    <select id="public-transit" name="public-transit">
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
                    <input type="submit" class="cr-submit-button no-radius" value="101 Ergebnisse anzeigen">
                </td>
            </tr>
        </table>
    </div><!-- .col -->
</form><!-- .row -->

<br>
<div class="row site-content" style="border-bottom: 1px solid black; padding-bottom: 3px;">
    <div class="col-sm-auto" style="color: red; background-color: rgb(187, 187, 187);">Ergebnisliste
    </div>
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
    <a onclick="alert('Angebot {{ $offer->apartment->source_id }}\nTODO: Detailansicht: Ticket #941.');" class="row site-content offer-list-view-entry offer-list-view-entry-toggle-{{ $css_toggle_suffix }}">
        <div class="col-4">
            <img src="images/pexels-vecislavas-popa-1571463.jpg" width="300" height="200">
        </div>
        <div class="col-7">
            <h4><strong>Schöne Überschrift kommt noch (Ticket #924)</strong></h4>
            <?php
            // TODO: See Feature #961.
            if ($offer->apartment->apartment_type == 'Haus') {
                $nr_of_rooms_text = 'Haus mit ' . $offer->apartment->number_of_rooms . 'Zimmern';
            } else {
                $nr_of_rooms_text = $offer->apartment->number_of_rooms . '-Zi. Wohnung';
            }
            $today = date('Y-m-d');
            if ($offer->start_date > $today) {
                // TODO: Make this German.
                $start_date_text = $offer->start_date;
            } else {
                $start_date_text = 'sofort';
            }

            if ($offer->max_months > 0) {
                $max_months_text = 'höchstens ' . $offer->max_months . ' Monate';
            } else {
                $max_months_text = 'für unbefristet';
            }

            $rent_text = number_format((float)$offer->rent, 0, ',', '.') . ' EUR';
            ?>

            <p>{{ $nr_of_rooms_text }}, {{ $offer->apartment->size_sq_m }}m<sup>2</sup>, TODO: Stadtteil, {{ $offer->apartment->street }}</p>
            <p>TODO: Öffentliche Verkehrsmittel</p>
            <div style="text-align:right; width:100%;">
            <span style="float:left;"><strong>frei ab {{ $start_date_text }}</strong>, {{ $max_months_text }}, Mindestmietzeit {{ $offer->min_months }} Monate</span>Miete pro Monat: <strong>{{ $rent_text }}</strong>
            </div>

        </div>
    </a><!-- .row -->
@endforeach
@endsection
