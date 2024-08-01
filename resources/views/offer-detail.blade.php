@extends ('layouts/site')
@section ('content')

<div class="row site-content mt-4" style="border-bottom: 1px solid black; margin-top: 10px;">
    <div class="col-sm-auto cr-ui-tab-1" style="margin-right: 5px;">Expose</div>
    <div class="col-sm-auto cr-ui-tab-2">Lage</div>
    <div class="col-sm-auto cr-ui-tab-3" style="margin-left: 45px;"><a href="/offers">Ergebnisliste</a></div>
</div>

<div class="row site-content cr-detail-view-heading">
    <div class="col-sm-auto"><strong>A-{{ $offer->apartment->source_id }}</strong></div>
    <div class="col-sm-auto"><strong><?php echo $offer->getInfoAtAGlanceText(); ?></strong></div>
</div>
<div class="row site-content cr-detail-view-content">
    <?php
        echo $offer->apartment->makeImageSlideshow(
            'splide-main-slider',
            ['splide', 'p-0'],
            // This was necessary at one point, but now
            // apparently not, thought I'm not sure why.
            // ['detail-view-image']
        );
        echo $offer->apartment->makeImageSlideshow(
            'splide-thumbnail-slider',
            ['splide'],
            // This does not work as I had hoped.
            // ['mt-3']
        );
    ?>
</div>
<script>
    var main = new Splide('#splide-main-slider', {
        type       : 'fade',
        heightRatio: 0.5,
        pagination : false,
        arrows     : false,
        cover      : true,
    });
    var thumbnails = new Splide('#splide-thumbnail-slider', {
        rewind          : true,
        fixedWidth      : 104,
        fixedHeight     : 58,
        isNavigation    : true,
        gap             : 10,
        focus           : 'center',
        pagination      : false,
        cover           : true,
        dragMinThreshold: {
            mouse: 4,
            touch: 10,
        },
        breakpoints : {
            640: {
                fixedWidth  : 66,
                fixedHeight : 38,
            },
        },
    });
    main.sync(thumbnails);
    main.mount();
    thumbnails.mount();
</script>

{{-- TODO: The boxes for selecting which room's images should be displayed.
@php
$l = 9;
@endphp
@for ($i = 0; $i < $l; $i++)
    @if ($i % 6 == 0)
        <div class="row site-content" >
    @endif
    <!--
    TODO: The one that's selected should light up with some different colors.
    -->
    <div class="col-sm room-pics-box" onclick="alert('TODO: Feature #1136: Bilder');">TODO</div>
    @if ($i % 6 == 5 || $i == $l-1)
        </div>
    @endif
@endfor
--}}

<div class="row site-content cr-detail-view-heading">
    <div class="col-3"><strong>A-{{ $offer->apartment->source_id }}</strong></div>
    <div class="col-9"><strong>{{ $offer->apartment->title }}</strong></div>
</div>

<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Typ und Größe</strong></div>
    <div class="col-9">{{ $offer->apartment->number_of_rooms }}-Zi. {{ $offer->apartment->getTranslatedApartmentType() }}, {{ $offer->apartment->size_sq_m }}m<sup>2</sup></div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Monatsmiete</strong></div>
    <div class="col-9">{{ get_euro_text($offer->rent) }}</div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>verfügbar</strong></div>
    <div class="col-9">{{ $offer->getStartText() }}</div>
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
        {{ $offer->apartment->house->address->getCityCenterText() }}
    </div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Einschränkungen</strong></div>
    <div class="col-9">
        {{ $offer->getLimitationsText() }}
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
                $offer->apartment->getSpecials()
            );
        ?>
    </div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Hausinfo</strong></div>
    <div class="col-9">{{ $offer->apartment->house->getInfoText() }}</div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Wohnräume</strong></div>
    <div class="col-9">{{ $offer->apartment->getRoomText('living_room') }}</div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Küche</strong></div>
    <div class="col-9"><?php echo $offer->apartment->getRoomText('kitchen', true); ?></div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Bad</strong></div>
    <div class="col-9"><?php echo $offer->apartment->getRoomText('bathroom', true); ?></div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Ausstattung</strong></div>
    <div class="col-9"><?php echo $offer->apartment->getEquipmentText(); ?></div>
</div>
{{--
TODO: See Feature #1178
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Parken</strong></div>
    <div class="col-9"><small>Diese Daten müssen noch von der ETL-Pipeline normalisiert werden. In einer zukünftigen Version der Laravel-App möglicherweise schon ab v0.5, wird dieser Datensatz dann ebenfalls hier stehen. Siehe Features <a href="https://redmine.city-residence.de/issues/1135">1135</a> und <a href="https://redmine.city-residence.de/issues/1140">1140</a></small></div>
</div>
--}}

<div class="row site-content cr-detail-view-heading">
    <div class="col-9"><strong>Information zum Mietpreis</strong></div>
</div>

<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Kaution</strong></div>
    {{-- TODO: This will be refactored. See Feature #972. --}}
    <div class="col-9">{{ $offer->getSecurityDepositText() }}</div>
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
    <div class="col-3"><strong>Infos zur Wohnlage</strong></div>
    <div class="col-9"><strong>{{ $offer->apartment->title }}</strong></div>
</div>

<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"></div>
    <div class="col-9" id="map"></div>
    <?php
        echo $offer->apartment
                   ->house
                   ->address
                   ->getMapsHtml('400px', '100%');
    ?>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Öffentliche Verkehrsmittel</strong></div>
    <div class="col-9"> <?php echo $offer->apartment->house->address->getPublicTransitUls(); ?></div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>PKW</strong></div>
    <div class="col-9"> {{ $offer->apartment->house->address->getParkingRatingText() }}</div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Einkaufen</strong></div>
    <div class="col-9"><?php echo $offer->apartment->house->address->getShopsUl(); ?></div>
</div>
<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"><strong>Freizeit</strong></div>
    <div class="col-9"><?php echo $offer->apartment->house->address->getPointsOfInterestUl(); ?></div>
</div>

<div class="row site-content cr-detail-view-heading">
    <div class="col-9"><strong>Energieausweis</strong></div>
</div>

<div class="row site-content cr-detail-view-content border-bottom">
    <div class="col-3"></div>
    <div class="col-9">
        {!! $offer->apartment->house->getEnergyCertText() !!}
    </div>
</div>
@endsection
