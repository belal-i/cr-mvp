<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Http\Repositories\OfferRepository;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        return view('offer-detail', [
            'offer' => $offer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        //
    }

    public static function extractValidFilterParamsFromRequest(
        Request &$request): array
    {
        $returnParams = [];
        $filterFields = [
            'status',
            'apartment_type',
            'size_sq_m',
            'number_of_rooms-min',
            'number_of_rooms-max',
            'rent-min',
            'rent-max',
            'number_of_persons',
            'number_of_bedrooms',
            'start_date',
            'min_months',
            'neighborhood',
            'rating',
            // TODO: We'll likely ignore this field as well, until we complete
            // Redmine #1147
            // 'nearby_public_transit',
        ];
        foreach ($filterFields as $field) {
            $value = $request->input($field);
            if ($value === null)
                continue;
            // TODO: Sanitize?
            $returnParams[$field] = $value;
        }
        return $returnParams;
    }

    public static function extractOfferOrderByFromRequest(Request &$request): array
    {
        $orderBy = $request->input('order-by');
        switch ($orderBy) {
            case 'apartments.rating':
            case 'start_date':
                return [$orderBy, 'ASC'];
            case 'rent-ASC':
            case 'rent-DESC':
            case 'apartments.size_sq_m-ASC':
            case 'apartments.size_sq_m-DESC':
                $column    = explode('-', $orderBy)[0];
                $direction = explode('-', $orderBy)[1];
                return [$column, $direction];
            default:
                return ['apartments.date_created', 'DESC'];
        }
    }

    public static function makeEloquentOfferWhereClauses(
        array $filterParams, $predefinedClauses = []): array
    {
        $whereClauses = $predefinedClauses;

        foreach ($filterParams as $field => $value) {
            switch ($field) {
                case 'size_sq_m':
                case 'number_of_rooms-min':
                case 'rent-min':
                case 'number_of_persons':
                case 'number_of_rooms':
                case 'number_of_bedrooms':
                case 'min_months':
                case 'rating':
                    $fieldName = explode('-', $field)[0];
                    $whereClauses[] = [$fieldName, '>=', $value];
                    break;
                case 'start_date':
                case 'number_of_rooms-max':
                case 'rent-max':
                    $fieldName = explode('-', $field)[0];
                    $whereClauses[] = [$fieldName, '<=', $value];
                    break;
                // TODO: Special cases which we must deal with later on.
                case 'neighborhood':
                    break;
                default:
                    $whereClauses[] = [$field, '=', $value];
                    break;
            }
        }
        return $whereClauses;
    }
}
