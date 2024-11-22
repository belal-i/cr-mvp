<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Renter;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\ImageController;
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

// TODO: Maybe the read endpoints can be public?
Route::controller(AddressController::class)->group(function () {
    Route::middleware('auth:sanctum')->get('/addresses', 'index');
    Route::middleware('auth:sanctum')->get('/addresses/{address}', 'show');
    Route::middleware('auth:sanctum')->post('/addresses', 'store');
    Route::middleware('auth:sanctum')->put('/addresses/{address}', 'update');
    // TODO: Not working because of foreign key constraints.
    // Route::middleware('auth:sanctum')->delete('/addresses/{address}', 'destroy');
});

Route::get('/offers/count', function (Request $request) {
    $whereClauses = OfferController::makeEloquentOfferWhereClauses(
        OfferController::extractValidFilterParamsFromRequest($request)
    );
    return OfferRepository::getFilteredOffers($whereClauses)->count();
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
Route::controller(OfferController::class)->group(function () {
    // TODO: Perhaps we can refactor the routes above to use this one.
    // Route::middleware('auth:sanctum')->get('/offers', 'index');
    Route::middleware('auth:sanctum')->get('/offers/{offer}', 'show');
    Route::middleware('auth:sanctum')->post('/offers', 'store');
    Route::middleware('auth:sanctum')->put('/offers/{offer}', 'update');
    Route::middleware('auth:sanctum')->delete('/offers/{offer}', 'destroy');
});

Route::controller(UserController::class)->group(function () {
    Route::middleware('auth:sanctum')->get('/users', 'index');
    Route::middleware('auth:sanctum')->get('/users/{user}', 'show');
    Route::middleware('auth:sanctum')->post('/users', 'store');
    Route::middleware('auth:sanctum')->put('/users/{user}', 'update');
    Route::middleware('auth:sanctum')->delete('/users/{user}', 'destroy');
});

Route::controller(HouseController::class)->group(function () {
    Route::middleware('auth:sanctum')->get('/houses', 'index');
    Route::middleware('auth:sanctum')->get('/houses/{house}', 'show');
    Route::middleware('auth:sanctum')->post('/houses', 'store');
    Route::middleware('auth:sanctum')->put('/houses/{house}', 'update');
    Route::middleware('auth:sanctum')->delete('/houses/{house}', 'destroy');
});

Route::controller(ApartmentController::class)->group(function () {
    Route::middleware('auth:sanctum')->get('/apartments', 'index');
    Route::middleware('auth:sanctum')->get('/apartments/{apartment}', 'show');
    Route::middleware('auth:sanctum')->post('/apartments', 'store');
    Route::middleware('auth:sanctum')->put('/apartments/{apartment}', 'update');
    Route::middleware('auth:sanctum')->delete('/apartments/{apartment}', 'destroy');
});

Route::controller(RenterController::class)->group(function () {
    Route::middleware('auth:sanctum')->get('/renters', 'index');
    Route::middleware('auth:sanctum')->get('/renters/{renter}', 'show');
    Route::middleware('auth:sanctum')->post('/renters', 'store');
    Route::middleware('auth:sanctum')->put('/renters/{renter}', 'update');
    Route::middleware('auth:sanctum')->delete('/renters/{renter}', 'destroy');
});

Route::controller(ImageController::class)->group(function () {
    Route::middleware('auth:sanctum')->get('/images', 'index');
    Route::middleware('auth:sanctum')->get('/images/{image}', 'show');
    Route::middleware('auth:sanctum')->post('/images', 'store');
    Route::middleware('auth:sanctum')->put('/images/{image}', 'update');
    Route::middleware('auth:sanctum')->delete('/images/{image}', 'destroy');
});
