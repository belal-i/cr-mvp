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
        array $whereClauses,
        bool $returnResource = false
    )
    {
        $offers = Offer::select('offers.*')
            ->join('apartments', 'offers.apartment_id', 'apartments.id')
            ->join('houses', 'apartments.house_id', 'houses.id')
            ->join('addresses', 'houses.address_id', 'addresses.id');

        foreach ($whereClauses as $clause) {
            if (is_array($clause[0])) {
                $offers = $offers->where(function ($offers) use ($clause) {
                    $firstOrClause = array_shift($clause);

                    $offers = $offers->where($firstOrClause[0],
                        $firstOrClause[1], $firstOrClause[2]);

                    foreach ($clause as $orClause) {
                        $offers = $offers->orWhere($orClause[0],
                            $orClause[1], $orClause[2]);
                    }
                });
            } else {
                $offers = $offers->where($clause[0], $clause[1], $clause[2]);
            }
        }

        return $returnResource ? $offers->get() : $offers;
    }
}
