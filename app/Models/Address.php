<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Image;
use App\Models\User;
use App\Models\House;

class Address extends Model
{
    use CrudTrait;
    use HasFactory;

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function house(): HasOne
    {
        return $this->hasOne(House::class);
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
}
