<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Address;
use App\Models\Apartment;
use App\Models\Image;

class House extends Model
{
    use CrudTrait;
    use HasFactory;

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function getInfoText()
    {
        $infoArray = [];
        if (!empty($this->house_description) && !empty($this->house_type)) {
            $infoArray[] = "$this->house_description $this->house_type";
        }
        if (!empty($this->year_of_construction)) {
            $infoArray[] = "Bj. $this->year_of_construction";
        }
        return implode(', ', $infoArray);
    }

    public function getEnergyCertText()
    {
        if ($this->has_landmark_status)
            return 'Dieses Gebäude steht teilweise oder ganz unter Denkmalschutz, deshalb wird kein Energieausweis benötigt.';
        if ($this->energy_rating_type == 'NO_INFORMATION')
            return '';

        $result = [];
        switch ($this->energy_rating_type) {
            case 'ENERGY_CONSUMPTION':
                $result[] = 'Verbrauchsausweis';
                break;
            case 'ENERGY_REQUIRED':
                $result[] = 'Bedarfsausweis';
                break;
            // TODO: Enum field for "Denkmalschutz"
            default:
                break;
        }

        $energy_source_translations = [
            'ACID_GAS' => 'Flüssiggas',
            'BIO_ENERGY' => 'Bioenergie',
            'COMBINED_HEAT_AND_POWER_FOSSIL_FUELS' => 'KWK fossil',
            'COMBINED_HEAT_AND_POWER_PLANT' => 'KWK bio',
            'COMBINED_HEAT_AND_POWER_RENEWABLE_ENERGY' => 'KWK erneuerbar',
            'DISTRICT_HEATING' => 'Fernwärme',
            'ELECTRICITY' => 'Strom',
            'ENVIRONMENTAL_THERMAL_ENERGY' => 'Umweltwärme',
            'GAS' => 'Gas',
            'GAS_HEATING' => 'Gas Heizung',
            'HEAT_PUMP' => 'Wärmepumpe',
            'HEAT_SUPPLY' => 'Wärmelieferung',
            'LOCAL_HEATING' => 'Nahwärme',
            'NATURAL_GAS_LIGHT' => 'Erdgas L',
            'OIL' => 'Öl',
            'OIL_HEATING' => 'Öl Heizung',
            'SOLAR_HEATING' => 'Solarthermie',
            'SOUR_GAS' => 'Erdgas schwer',
            'STEAM_DISTRICT_HEATING' => 'Fernwärme-Dampf',
            'WOOD' => 'Holz',
            'WOOD_PELLET_HEATING' => 'Holzpellets',
        ];

        try {
            $result[] = sprintf(
                'Befeuerungsart: %s',
                $energy_source_translations[$this->energy_source]
            );
        } catch (\Exception) {
            // Catch PHP warning when array key 'NO_INFORMATION' is
            // not found, and do nothing.
        }

        $result[] = sprintf(
            'Endenergiebedarf %s kWh/(m<sup>2</sup>&sdot;a)',
            number_format(
                $this->energy_usage_value,
                2,
                ',',
                '.',
            )
        );

        $result[] = sprintf('Baujahr %s', $this->year_of_construction);

        return implode(', ', $result);
    }
}
