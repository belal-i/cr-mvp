<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Repositories\OfferRepository;
use App\Http\Resources\OfferResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/offers', function (Request $request) {
    $whereClauses = OfferController::makeEloquentOfferWhereClauses(
        OfferController::extractValidFilterParamsFromRequest($request)
    );
    $orderBy = OfferController::extractOfferOrderByFromRequest($request);

    return new OfferResource(
        OfferRepository::getFilteredOffers($whereClauses)
                       ->orderBy($orderBy[0], $orderBy[1])
                       ->get()
    );
});

Route::get('/offers/count', function (Request $request) {
    $whereClauses = OfferController::makeEloquentOfferWhereClauses(
        OfferController::extractValidFilterParamsFromRequest($request)
    );
    return OfferRepository::getFilteredOffers($whereClauses)->count();
});
