<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Address;
use App\Models\Apartment;

class House extends Model
{
    use HasFactory;

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class);
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
}
