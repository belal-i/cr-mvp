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
            // TODO: cr-legacy-to-json currently does not supply data for this field.
            // 'number_of_bedrooms',
            // TODO: Currently there is a problem with the dates, I think
            // we're getting wrong results, seems like I'm getting too few results.
            // 'start_date',
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

    public static function makeEloquentOfferWhereClauses(
        array $filterParams, $predefinedClauses = []): array
    {
        $whereClauses = $predefinedClauses;

        foreach ($filterParams as $field => $value) {
            switch ($field) {
                case 'size_sq_m':
                case 'number_of_rooms-min':
                case 'rent-min':
                case 'number_of_persons': // this goes here?
                case 'number_of_rooms': // this goes here?
                case 'min_months': // this goes here?
                case 'rating':
                    $fieldName = explode('-', $field)[0];
                    $whereClauses[] = [$fieldName, '>=', $value];
                    break;
                case 'number_of_rooms-max':
                case 'start_date': // this goes here?
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
