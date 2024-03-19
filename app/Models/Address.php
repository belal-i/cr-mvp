<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Contact;
use App\Models\House;

class Address extends Model
{
    use HasFactory;

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
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
}
