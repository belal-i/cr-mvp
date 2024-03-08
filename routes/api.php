<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Repositories\OfferRepository;

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

// TODO: This endpoint should not be activated until we
// complete Redmine #1152.
// Otherwise, we might leak sensitive information!
// See https://redmine.city-residence.de/issues/1152
// Route::get('/offers', function (Request $request) {
//     $whereClauses = OfferController::makeEloquentOfferWhereClauses(
//         OfferController::extractValidFilterParamsFromRequest($request)
//     );
//     return OfferRepository::getFilteredOffers($whereClauses, true);
// });

Route::get('/offers/count', function (Request $request) {
    $whereClauses = OfferController::makeEloquentOfferWhereClauses(
        OfferController::extractValidFilterParamsFromRequest($request)
    );
    return OfferRepository::getFilteredOffers($whereClauses)->count();
});
