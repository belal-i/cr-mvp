<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Text;
use App\Models\Offer;
use App\Http\Repositories\OfferRepository;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\InquiryController;

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

Route::get('/offers/{id}', function ($id) {
    $offer = Offer::findOrFail($id);
    return view('offer-detail', [
        'offer' => $offer,
    ]);
});

Route::get('/inquire/{offer_id}', function ($offerId) {
    // TODO: The offer should actually be optional...
    // Should be possible to send inquiries without the offer.
    $offer = Offer::findOrFail($offerId);
    return view('inquire', [
        'offer' => $offer
    ]);
});

Route::post('send-inquiry', [InquiryController::class, 'store']);

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

Route::get('/tos', function () {
    return view('content', [
        'contentText' => Text::getText('TOS'),
    ]);
});

Route::get('/privacy-policy', function () {
    return view('content', [
        'contentText' => Text::getText('PRIVACY_POLICY'),
    ]);
});

Route::get('/thanks', function () {
    return view('content', [
        'contentText' => Text::getText('THANKS'),
    ]);
});
