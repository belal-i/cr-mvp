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
}
