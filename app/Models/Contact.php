<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Address;

class Contact extends Model
{
    use CrudTrait;
    use HasFactory;

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
