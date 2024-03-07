@extends ('layouts/site')
@section ('content')

{{-- TODO: See Redmine #1135. This was implemented very quickly and not very clean. --}}
<div class="row site-content" style="border-bottom: 1px solid black; margin-top: 10px;">
    <div class="col-sm-auto cr-ui-tab-1" style="margin-right: 5px;">Expose</div>
    <div class="col-sm-auto cr-ui-tab-2">Lage</div>
    <div class="col-sm-auto cr-ui-tab-3" style="margin-left: 45px;"><a href="/offers">Ergebnisliste</a></div>
</div>

<?php
$info_at_a_glance_text = $offer->apartment->number_of_rooms . '-Zi. '
    . $offer->apartment->translateApartmentType() . ' | '
    . $offer->apartment->size_sq_m . 'm<sup>2</sup> | '
    . get_euro_text($offer->rent) . ' | '
    . $offer->apartment->house->address->neighborhood;
?>
<div class="row site-content cr-detail-view-heading">
    <div class="col-sm-auto"><strong>A-{{ $offer->apartment->source_id }}</strong></div>
    <div class="col-sm-auto"><strong><?php echo $info_at_a_glance_text; ?></strong></div>
</div>
<div class="row site-content cr-detail-view-content">
    <img src="/images/pexels-vecislavas-popa-1571463.jpg" style="width: 100%;">
</div>

<?php
// TODO: This is hardcoded, obviously it needs to be fetched from
// the database dynamically.
$room_pic_boxes = [
    'Übersicht',
    'Wohnen (7)',
    'Schlafzimmer (7)',
    '2. Schlafzimmer (7)',
    'Küche (7)',
    'Bad (7)',
    'Balkon/Terasse (7)',
    '2. Balkon (7)',
    'Flur (7)',
    'Hausflur (7)',
    'Umgebung (7)',
    'Außenansicht (7)',
];
$l = count($room_pic_boxes);
?>

@for ($i = 0; $i < $l; $i++)
    @if ($i % 6 == 0)
        <div class="row site-content" >
    @endif
    {{-- TODO: The one that's selected should light up with some different colors. --}}
    <div class="col-sm room-pics-box" onclick="alert('TODO: Feature #1136: Bilder');">{{ $room_pic_boxes[$i] }}</div>
    @if ($i % 6 == 5 || $i == $l-1)
        </div>
    @endif
@endfor

<div class="row site-content cr-detail-view-heading">
    <div class="col-3"><strong>A-{{ $offer->apartment->source_id }}</strong></div>
    <div class="col-9"><strong>{{ $offer->apartment->title }}</strong></div>
</div>

<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Typ und Größe</strong></div>
    <div class="col-9">{{ $offer->apartment->number_of_rooms }}-Zi. {{ $offer->apartment->translateApartmentType() }}, {{ $offer->apartment->size_sq_m }}m<sup>2</sup></div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Monatsmiete</strong></div>
    <div class="col-9">{{ get_euro_text($offer->rent) }}</div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>verfügbar</strong></div>
    <div class="col-9">{{ get_start_text_from_date($offer->start_date) }}</div>
</div>

<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Mindestmietzeit</strong></div>
    <div class="col-9">{{ $offer->min_months }} Monate</div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Lage</strong></div>
    <div class="col-9">
        {{ $offer->apartment->house->address->zip_code }} {{ $offer->apartment->house->address->neighborhood }}
        <br>
        {{ $offer->apartment->house->address->street }}
        <br>
        <small>Siehe <a href="https://redmine.city-residence.de/issues/1135">Feature #1135</a> Die Entfernung zur Innenstadt soll dann auch angezeigt werden.</small>
    </div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Einschränkungen</strong></div>
    <div class="col-9">
        {{ get_offer_limitations_text($offer) }}
    </div>
</div>

<div class="row site-content cr-detail-view-heading">
    <div class="col-9"><strong>Beschreibung der Wohnung</strong></div>
</div>

<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Specials</strong></div>
    <div class="col-9">
        <?php
            echo php_array_to_ul_elem(
                extract_german_apartment_specials($offer->apartment->specials)
            );
        ?>
    </div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Hausinfo</strong></div>
    <div class="col-9">{{ get_house_info_text($offer->apartment->house) }}</div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Wohnräume</strong></div>
    <div class="col-9">{{ get_living_room_text($offer->apartment) }}</div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Küche</strong></div>
    <div class="col-9"><small>Diese Daten müssen noch von der ETL-Pipeline normalisiert werden. In einer zukünftigen Version der Laravel-App möglicherweise schon ab v0.5, wird dieser Datensatz dann ebenfalls hier stehen. Siehe Features <a href="https://redmine.city-residence.de/issues/1135">1135</a> und <a href="https://redmine.city-residence.de/issues/1140">1140</a></small></div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Bad</strong></div>
    <div class="col-9"><small>Diese Daten müssen noch von der ETL-Pipeline normalisiert werden. In einer zukünftigen Version der Laravel-App möglicherweise schon ab v0.5, wird dieser Datensatz dann ebenfalls hier stehen. Siehe Features <a href="https://redmine.city-residence.de/issues/1135">1135</a> und <a href="https://redmine.city-residence.de/issues/1140">1140</a></small></div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Ausstattung</strong></div>
    <div class="col-9"><small>Diese Daten müssen noch von der ETL-Pipeline normalisiert werden. In einer zukünftigen Version der Laravel-App möglicherweise schon ab v0.5, wird dieser Datensatz dann ebenfalls hier stehen. Siehe Features <a href="https://redmine.city-residence.de/issues/1135">1135</a> und <a href="https://redmine.city-residence.de/issues/1140">1140</a></small></div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Parken</strong></div>
    <div class="col-9"><small>Diese Daten müssen noch von der ETL-Pipeline normalisiert werden. In einer zukünftigen Version der Laravel-App möglicherweise schon ab v0.5, wird dieser Datensatz dann ebenfalls hier stehen. Siehe Features <a href="https://redmine.city-residence.de/issues/1135">1135</a> und <a href="https://redmine.city-residence.de/issues/1140">1140</a></small></div>
</div>

<div class="row site-content cr-detail-view-heading">
    <div class="col-9"><strong>Information zum Mietpreis</strong></div>
</div>

<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Kaution</strong></div>
    {{-- TODO: This will be refactored. See Feature #972. --}}
    <div class="col-9">{{ get_security_deposit_text($offer->security_deposit, $offer->security_deposit_type) }}</div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Radio- und TV-Empfang</strong></div>
    <div class="col-9">Der Rundfunkbeitrag für die öffentlich-rechtlichen Rundfunkanstalten von derzeit 18,36 Euro ist vom Mieter direkt an <a href="http://www.rundfunkbeitrag.de">ARD ZDF Deutschlandradio-Beitragsservice</a> zu zahlen. Er ist nicht in der Miete enthalten, soweit nichts anderes ausgewiesen ist.</div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Provisionsfrei</strong></div>
    <div class="col-9">Unsere Vermittlungsleistung ist nach §2 Abs.1a WohnVermittG für Mieter provisionsfrei.</div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Reinigung</strong></div>
    <div class="col-9">Obligatorische Reinigungskosten nach Auszug des Mieters.</div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Wohnungsgeberbestätigung</strong></div>
    <div class="col-9">Mit dem Abschluss des Mietvertrages erhalten Sie als Mieter eine Wohnungsgeberbestätigung, die für die Anmeldung als Wohnsitz in Frankfurt erforderlich ist.</div>
</div>

<div class="row site-content cr-detail-view-heading">
    <div class="col-9"><strong>Infos zur Wohnlage</strong></div>
</div>

<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Google-Maps</strong></div>
    <div class="col-9">Die Integration mit Google-Maps wird in einer zukünftigen Version implementiert sein. Siehe <a href="https://redmine.city-residence.de/issues/1134">Feature #1134</a></div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Öffentliche Verkehrsmittel</strong></div>
    <div class="col-9"> <?php echo get_public_transit_uls($offer->apartment->house->address->nearby_public_transit); ?></div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>PKW</strong></div>
    <div class="col-9"> {{ get_parking_situation_text($offer->apartment->house->address->parking_rating) }}</div>
</div>
{{-- TODO: See Feature #1139. We'll have two separate columns for this in the future. --}}
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Einkaufen und Freizeit</strong></div>
    <div class="col-9"> <?php echo get_points_of_interest_ul($offer->apartment->house->address->nearby_points_of_interest); ?><small>Die ETL-Pipeline liefert in ihrer aktuellen Version (cr-legacy-to-json-0.2) Freizeit- und Einkaufsmöglichkeiten in einem Feld. In einer zukünftigen Version sollen diese Daten allerdings in 2 getrennten Feldern verfügbar sein. Siehe <a href="https://redmine.city-residence.de/issues/1139">Feature #1139</a></small></div>
</div>

<div class="row site-content cr-detail-view-heading">
    <div class="col-9"><strong>Energieausweis</strong></div>
</div>

<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"></div>
    <div class="col-9">
        <p class="border-bottom">Energieausweisdaten</p>
        <table>
            <tr>
                <th>Baujahr:</th>
                <td>{{ $offer->apartment->house->year_of_construction }}</td>
            </tr>
            <tr>
                <th>energy_rating_type:</th>
                <td>{{ $offer->apartment->house->energy_rating_type }}</td>
            </tr>
            <tr>
                <th>energy_source:</th>
                <td>{{ $offer->apartment->house->energy_source }}</td>
            </tr>
            <tr>
                <th>energy_usage_value:</th>
                <td>{{ $offer->apartment->house->energy_usage_value }}</td>
            </tr>
            <tr>
                <th>Warmwasser enthalten:</th>
                <td>
                    @if ($offer->apartment->house->energy_consumption_contains_warm_water == 1)
                        Ja
                    @else
                        Nein
                    @endif
                </td>
            </tr>
        </table>
        <small>Siehe <a href="https://redmine.city-residence.de/issues/1135">Feature #1135</a> Wir müssen bloß klären, wie alle möglichen Enum-Werte zu den Energieausweisen übersetzt werden sollen, bzw. ich muss es aus dem Legacy-Code herauslesen.</small>
    </div>
</div>
@endsection
