<?php

namespace App\Http\Repositories;

use App\Models\Offer;

class OfferRepository
{
    public static function getAllOffers()
    {
        return Offer::all();
    }

    public static function getFreeOffers()
    {
        return Offer::where('status', '=', 'F');
    }

    public static function getFilteredOffers(array $offerCriteria)
    {
        // TODO
    }
}
