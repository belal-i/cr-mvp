<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Address;
use App\Models\House;
use App\Models\Apartment;

class Image extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    public const API_FIELDS = [
        'id',
        'apartment_id',
        'house_id',
        'address_id',
        'file_extension',
        'image_type',
        'sort_order',
        'created_at',
        'updated_at',
    ];

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

    public function getFilePath()
    {
        return sprintf(
            '%s.%s',
            $this->id,
            $this->file_extension
        );
    }
}
