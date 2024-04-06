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
        foreach ($filterParams as &$eloquentWhereClause) {
            $fieldName = $eloquentWhereClause[0];
            switch ($fieldName) {
                case 'apartment_type':
                case 'has_balcony':
                case 'has_dish_washer':
                case 'has_internet':
                case 'has_parking_space':
                case 'has_washing_machine':
                case 'number_of_bedrooms':
                case 'number_of_rooms':
                case 'pets_ok':
                case 'rating':
                case 'size_sq_m':
                    $eloquentWhereClause[0] = "apartments.$fieldName";
                    break;
                case 'has_elevator':
                    $eloquentWhereClause[0] = "houses.$fieldName";
                    break;
                default:
                    $eloquentWhereClause[0] = $fieldName;
                    break;
            }
        }

        $offers = Offer::select('offers.*')
            ->join('apartments', 'offers.apartment_id', 'apartments.id')
            ->join('houses', 'apartments.house_id', 'houses.id')
            ->join('addresses', 'houses.address_id', 'addresses.id')
            ->where($filterParams);

        return $returnResource ? $offers->get() : $offers;
    }
}
