<?php

namespace App\Http\Repositories;

use App\Models\Offer;

class OfferRepository
{
    public static function getAllOffers()
    {
        return Offer::all();
    }

    public static function getFreeOffers(bool $returnResource = false)
    {
        $filterParams = [['status', 'F']];
        return self::getFilteredOffers($filterParams, $returnResource);
    }

    public static function getFilteredOffers(
        array $filterParams,
        bool $returnResource = false
    )
    {
        $offers = Offer::select('offers.*')
            ->join('apartments', 'offers.apartment_id', 'apartments.id')
            ->join('houses', 'apartments.house_id', 'houses.id')
            ->join('addresses', 'houses.address_id', 'addresses.id')
            ->where($filterParams);

        return $returnResource ? $offers->get() : $offers;
    }
}
