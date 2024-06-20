<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use App\Models\Address;
use App\Models\House;
use App\Models\Apartment;

class Image extends Model
{
    use CrudTrait;
    use HasFactory;

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function getImgTag($htmlId = null, $htmlClasses = null)
    {
        return sprintf(
            '<img src="%s"%s%s>',
            $this->getImgUrl(),
            empty($htmlId)
                ? ''
                : ' id="' . $htmlId . '"',
            empty($htmlClasses)
                ? ''
                : ' class="' . implode(' ', $htmlClasses) . '"'
        );
    }

    public function getImgUrl()
    {
        return Storage::url($this->id . '.' . $this->file_extension);
    }
}
