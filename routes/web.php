<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Repositories\OfferRepository;
use App\Http\Controllers\OfferController;
use App\Models\Text;

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
    return view('home', [
        'offerCount'  => OfferRepository::countFreeOffers(),
        'bannerText'  => Text::getText('HOMEPAGE_BANNER'),
        'contentText' => Text::getText('HOMEPAGE_CONTENT'),
    ]);
});

Route::get('/offers', function (Request $request) {
    $filterParams = OfferController::extractValidFilterParamsFromRequest(
        $request
    );
    $whereClauses = OfferController::makeEloquentOfferWhereClauses(
        $filterParams,
        [['status', '=', 'FREE']]
    );
    $orderBy = OfferController::extractOfferOrderByFromRequest($request);

    $offers = OfferRepository::getFilteredOffers($whereClauses)
                             ->orderBy($orderBy[0], $orderBy[1]);
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

Route::get('/renter-info', function () {
    return view('content', [
        'contentText' => Text::getText('RENTER_INFO'),
    ]);
});

Route::get('/make-offer', function () {
    return view('content', [
        'contentText' => Text::getText('CONTACT'),
    ]);
});

Route::get('/landlord-info', function () {
    return view('content', [
        'contentText' => Text::getText('LANDLORD_INFO'),
    ]);
});

Route::get('/interior-design', function () {
    return view('content', [
        'contentText' => Text::getText('INTERIOR_DESIGN'),
    ]);
});

Route::get('/about', function () {
    return view('content', [
        'contentText' => Text::getText('ABOUT'),
    ]);
});
