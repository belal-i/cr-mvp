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
            'apartment_type',
            'elevator-cutoff-story',
            'has_balcony',
            'has_dish_washer',
            'dryer',
            'has_elevator',
            'has_internet',
            'has_parking_space',
            'min_months',
            'neighborhood',
            'number_of_bedrooms',
            'number_of_persons',
            'number_of_rooms-max',
            'number_of_rooms-min',
            'pets_ok',
            'rating',
            'rent-max',
            'rent-min',
            'size_sq_m',
            'start_date',
            'start_date-ui',
            'status',
            'washing_machine',
            'washing_machine_in_apartment',
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
                return ['date_published', 'DESC'];
        }
    }

    public static function makeEloquentOfferWhereClauses(
        array $filterParams, $predefinedClauses = []): array
    {
        $whereClauses = $predefinedClauses;

        foreach ($filterParams as $field => $value) {
            switch ($field) {
                case 'apartment_type':
                case 'has_balcony':
                case 'has_dish_washer':
                case 'has_internet':
                case 'has_parking_space':
                case 'number_of_bedrooms':
                case 'number_of_rooms':
                case 'number_of_rooms-min':
                case 'number_of_rooms-max':
                case 'pets_ok':
                case 'rating':
                case 'size_sq_m':
                    $field = "apartments.$field";
                    break;
                case 'has_elevator':
                    $field = "houses.$field";
                    break;
                case 'neighborhood':
                    $field = "addresses.$field";
                    break;
                default:
                    break;
            }

            // Checkboxes
            if ($value == 'on')
                $value = '1';
            switch ($field) {
                case 'apartments.number_of_bedrooms':
                case 'apartments.number_of_rooms-min':
                case 'apartments.number_of_rooms':
                case 'apartments.rating':
                case 'apartments.size_sq_m':
                case 'rent-min':
                case 'number_of_persons':
                    $fieldName = explode('-', $field)[0];
                    $whereClauses[] = [$fieldName, '>=', $value];
                    break;
                case 'apartments.number_of_rooms-max':
                case 'min_months':
                case 'rent-max':
                case 'start_date':
                    $fieldName = explode('-', $field)[0];
                    $whereClauses[] = [$fieldName, '<=', $value];
                    break;
                case 'start_date-ui':
                    // TODO: Improve this validation.
                    try {
                        $tmpDate = date_create($value);
                        date_add(
                            $tmpDate,
                            date_interval_create_from_date_string('3 days')
                        );
                        $filterDate = date_format($tmpDate, 'Y-m-d');
                        $whereClauses[] = ['start_date', '<=', $filterDate];
                    } catch (\Throwable $e) {
                        break;
                    }
                    break;
                case 'washing_machine_in_apartment':
                    $whereClauses[] = ['apartments.has_washing_machine', '=', $value];
                    break;
                case 'washing_machine':
                    $whereClauses[] = [
                        ['apartments.has_washing_machine', '=', $value],
                        ['houses.has_washing_machine', '=', $value],
                    ];
                    break;
                case 'dryer':
                    $whereClauses[] = [
                        ['apartments.has_dryer', '=', $value],
                        ['houses.has_dryer', '=', $value],
                    ];
                    break;
                case 'houses.has_elevator':
                    if (isset($filterParams['elevator-cutoff-story'])
                        && $filterParams['elevator-cutoff-story'] > 0
                    ) {
                        $whereClauses[] = [
                            [$field, '=', $value],
                            ['apartments.story',
                                '<', $filterParams['elevator-cutoff-story']],
                        ];
                    } else {
                        $whereClauses[] = [$field, '=', $value];
                    }
                    break;
                case 'addresses.neighborhood':
                    switch ($value) {
                        case 'Frankfurt-Stadt':
                            $neighborhoods = CR_FRANKFURT_NEIGHBORHOODS;
                            break;
                        case 'Frankfurt-Innenstadt':
                            $neighborhoods = CR_FRANKFURT_DOWNTOWN_NEIGHBORHOODS;
                            break;
                        case 'Offenbach u. Umgebung':
                            $neighborhoods = CR_OFFENBACH_NEIGHBORHOODS;
                            break;
                        case 'Vordertaunus':
                            $neighborhoods = CR_VORDERTAUNUS_NEIGHBORHOODS;
                            break;
                        case 'Frankfurt u. Umgebung':
                        default:
                            $neighborhoods = [];
                            break;
                    }

                    if (empty($neighborhoods))
                        break;

                    $neighborhoodOrWhereClauses = [];
                    foreach ($neighborhoods as $neighborhood) {
                        $neighborhoodOrWhereClauses[] = [$field, '=', $neighborhood];
                    }

                    $whereClauses[] = $neighborhoodOrWhereClauses;

                    break;
                // In some cases, it's a valid filter field, but it's handled
                // separately because it's a special case, and so when it is
                // processed by the switch statement, we actually want to do
                // nothing.
                case 'elevator-cutoff-story':
                    break;
                default:
                    $whereClauses[] = [$field, '=', $value];
                    break;
            }
        }
        return $whereClauses;
    }
}
