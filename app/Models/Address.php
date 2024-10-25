<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Geocoder\Query\GeocodeQuery;
use App\Models\Image;
use App\Models\User;
use App\Models\House;

class Address extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    public function getSubwayStationsAsList(): array
    {
        $subway_stations = json_decode($this->nearby_public_transit, true);
        $subway_stations = $subway_stations["subway"] ?? [];
        return array_keys($subway_stations);
    }

    public function getCityCenterText()
    {
        if (empty($this->distance_from_city_center_m)
            || empty($this->compass_direction_from_city_center)
        ) {
            return '';
        }

        $compassTranslations = [
            'N' => 'nördlich',
            'NE' => 'nordöstlich',
            'E' => 'östlich',
            'SE' => 'südöstlich',
            'S' => 'südlich',
            'SW' => 'südwestlich',
            'W' => 'westlich',
            'NW' => 'nordwestlich',
        ];
        if ($this->distance_from_city_center_m < 1000)
            $distanceText = $this->distance_from_city_center_m . 'm';
        else
            $distanceText = number_format(
                $this->distance_from_city_center_m / 1000,
                1,
                ',',
                '.',
            ) . 'km';
        return sprintf(
            'ca. %s %s der Innenstadt',
            $distanceText,
            $compassTranslations[$this->compass_direction_from_city_center]
        );
    }

    // TODO: See Feature #1147 - also, when you refactor this, change it to make
    // use of the function php_array_to_ul_elem
    public function getPublicTransitUls()
    {
        $retHtml = '<p class="border-bottom">U-Bahn:</p>';
        $retHtml .= "<ul>";
        $public_transit_array = json_decode($this->nearby_public_transit, true);
        $subway_array = $public_transit_array['subway'] ?? [];
        foreach ($subway_array as $station => $distance) {
            $retHtml .= "<li>Haltestelle \"$station\" ($distance)</li>"; 
        }
        $retHtml .= "</ul>";
        // $retHtml .= '<p class="border-bottom">S-Bahn:</p>';
        // $retHtml .= 'TODO';
        return $retHtml;
    }

    // TODO: These 2 functions could be refactored...
    public function getPointsOfInterestUl()
    {
        $retHtml = "<ul>";
        $poiArray = json_decode($this->nearby_points_of_interest, true);
        if (empty($poiArray))
            $poiArray = [];
        foreach ($poiArray as $poiEntry ) {
            if (isset($poiEntry['sub'])) {
                $retHtml .= "<li>{$poiEntry['sub']}";
                if (isset($poiEntry['dist'])) {
                    $retHtml .= " ({$poiEntry['dist']})";
                }
                $retHtml .= "</li>";
            }
        }
        $retHtml .= "</ul>";
        return $retHtml;
    }

    public function getShopsUl()
    {
        $retHtml = "<ul>";
        $shopsArray = json_decode($this->nearby_shops, true);
        if (empty($shopsArray))
            $shopsArray = [];
        foreach ($shopsArray as $shopEntry ) {
            if (isset($shopEntry['sub'])) {
                $retHtml .= "<li>{$shopEntry['sub']}";
                if (isset($shopEntry['dist'])) {
                    $retHtml .= " ({$shopEntry['dist']})";
                }
                $retHtml .= "</li>";
            }
        }
        $retHtml .= "</ul>";
        return $retHtml;
    }

    public function getParkingRatingText()
    {
        switch ($this->parking_rating) {
            case 6:
            case 5:
                return 'Exzellente Parkmöglichkeiten';
            case 4:
                return 'Gute Parkmöglichkeiten';
            case 3:
                return 'Parkmöglichkeiten auf der Straße';
            case 2:
            case 1:
                return 'Geringe Parkmöglichkeiten auf der Straße';
            default:
                return '';
        }
    }

    public function getGeocoordinates()
    {
        $httpClient = new \GuzzleHttp\Client();
        $provider = new \Geocoder\Provider\GoogleMaps\GoogleMaps(
            $httpClient,
            null,
            getenv('GOOGLE_MAPS_API_KEY')
        );
        // TODO: Keep this in mind for Redmine #979.
        $geocoder = new \Geocoder\StatefulGeocoder($provider, 'de');

        return app('geocoder')->geocode(
            sprintf(
                '%s %s, %s %s',
                $this->street,
                $this->house_number,
                $this->zip_code,
                $this->city
            )
        )->get()[0]->getCoordinates();
    }

    public function getMapsHtml($height, $width, $htmlId = 'map')
    {
        $googleMapsApiKey = getenv('GOOGLE_MAPS_API_KEY');
        try {
            $coordinates = $this->getGeocoordinates();
        } catch (\Exception $e) {
            // TODO: See Redmine #1255: Log this to Sentry.
            // TODO: See Redmine #979: Translate the error message.
            return <<<EOF
                <script>
                    window.onload = function() {
                        $('#$htmlId').html(
                            'Problem mit Geokoordinaten oder Google-Maps allgemein. address_id: $this->id'
                        );
                    }
                </script>
EOF;
        }
        $pinTag = asset('images/CRpin_activ.png');

        return <<<EOF
            <style>
                #$htmlId {
                    height: $height;
                    width: $width;
                }
            </style>
            <script
                type="text/javascript"
                src="//maps.googleapis.com/maps/api/js?key=$googleMapsApiKey"></script>

            <script>
                function initialize()
                {
                    try
                    {
                        var latlng = new google.maps.LatLng(
                            {$coordinates->getLatitude()},
                            {$coordinates->getLongitude()}
                        );
                        var mapOptions = {
                            zoom: 14,
                            center: latlng,
                            navigationControl: true,
                            mapTypeControl: true,
                            scaleControl: true,
                            zoomControl: true,
                            streetViewControl: true,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                            /*
                            mapTypeIds: [
                                    google.maps.MapTypeId.ROADMAP,
                                    google.maps.MapTypeId.TERRAIN,
                                    google.maps.MapTypeId.HYBRID,
                                    google.maps.MapTypeId.SATELLITE
                                ]
                            */
                        };
                        map = new google.maps.Map(document.getElementById("$htmlId"), mapOptions);
                        var transitLayer = new google.maps.TransitLayer();
                        transitLayer.setMap(map);

                        var image = "{$pinTag}";
                        var offerMarker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            icon: image,
                            title: "{$this->source_id}"
                        });
                    }
                    catch(e)
                    {
                        setTimeout("initialize()", 2500);
                    }
                }
                setTimeout("initialize()", 1500);
            </script>
EOF;
    }
}
