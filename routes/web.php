<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Repositories\OfferRepository;
use App\Http\Controllers\OfferController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $offerCount = OfferRepository::getFreeOffers()->count();
    return view('home', ['offerCount' => $offerCount]);
});

Route::get('/offers', function (Request $request) {
    $filterParams = OfferController::extractValidFilterParamsFromRequest(
        $request
    );
    $whereClauses = OfferController::makeEloquentOfferWhereClauses(
        $filterParams,
        [['status', '=', 'FREE']]
    );

    $offers = OfferRepository::getFilteredOffers($whereClauses);
    $offerCount = $offers->count();
    $offers = $offers->paginate(25);

    return view('offers-list', [
        'offers' => $offers,
        'offerCount' => $offerCount,
        // TODO: Use the session for this. See https://laravel.com/docs/10.x/session
        'filterParams' => $filterParams,
    ]);
});

Route::get('/offers/{offer}', [OfferController::class, 'show']);
