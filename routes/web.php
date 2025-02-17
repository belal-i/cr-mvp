<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
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
    //var_dump(App::currentLocale());
    return view('home', [
        'offerCount'  => OfferRepository::countFreeOffers(),
        'bannerText'  => __(Text::getText('HOMEPAGE_BANNER')),
        'contentText' => Text::getText('HOMEPAGE_CONTENT'),
    ]);
});

Route::get('/de', function () {
    App::setLocale('de');
    // TODO: Would be cool if this worked, but it looks like when redirecting,
    // the locale is set back to the default.
    // However, this will be refactored again anyway.
    //return redirect('/');
    return view('home', [
        'offerCount'  => OfferRepository::countFreeOffers(),
        'bannerText'  => __(Text::getText('HOMEPAGE_BANNER')),
        'contentText' => Text::getText('HOMEPAGE_CONTENT'),
    ]);
});

Route::get('/en', function () {
    App::setLocale('en');
    return view('home', [
        'offerCount'  => OfferRepository::countFreeOffers(),
        'bannerText'  => __(Text::getText('HOMEPAGE_BANNER')),
        'contentText' => Text::getText('HOMEPAGE_CONTENT'),
    ]);
});

Route::get('/fr', function () {
    App::setLocale('fr');
    return view('home', [
        'offerCount'  => OfferRepository::countFreeOffers(),
        'bannerText'  => __(Text::getText('HOMEPAGE_BANNER')),
        'contentText' => Text::getText('HOMEPAGE_CONTENT'),
    ]);
});

Route::get('/es', function () {
    App::setLocale('es');
    return view('home', [
        'offerCount'  => OfferRepository::countFreeOffers(),
        'bannerText'  => __(Text::getText('HOMEPAGE_BANNER')),
        'contentText' => Text::getText('HOMEPAGE_CONTENT'),
    ]);
});

Route::get('/it', function () {
    App::setLocale('it');
    return view('home', [
        'offerCount'  => OfferRepository::countFreeOffers(),
        'bannerText'  => __(Text::getText('HOMEPAGE_BANNER')),
        'contentText' => Text::getText('HOMEPAGE_CONTENT'),
    ]);
});

Route::get('/offers', function (Request $request) {
    $offers = get_offers_from_request($request);
    $offerCount = $offers->count();
    // TODO: Not so good, should be refactored too.
    $filterParams = OfferController::extractValidFilterParamsFromRequest(
        $request
    );

    return view('offers-list', [
        'offers' => $offers,
        'offerCount' => $offerCount,
        // TODO
        // TODO: Use the session for this. See https://laravel.com/docs/10.x/session
        'filterParams' => $filterParams,
    ]);
});

Route::get('/de/offers', function (Request $request) {
    App::setLocale('de');
    $offers = get_offers_from_request($request);
    $offerCount = $offers->count();
    // TODO: Not so good, should be refactored too.
    $filterParams = OfferController::extractValidFilterParamsFromRequest(
        $request
    );

    return view('offers-list', [
        'offers' => $offers,
        'offerCount' => $offerCount,
        // TODO: Use the session for this. See https://laravel.com/docs/10.x/session
        'filterParams' => $filterParams,
    ]);
});

Route::get('/en/offers', function (Request $request) {
    App::setLocale('en');
    $offers = get_offers_from_request($request);
    $offerCount = $offers->count();
    // TODO: Not so good, should be refactored too.
    $filterParams = OfferController::extractValidFilterParamsFromRequest(
        $request
    );

    return view('offers-list', [
        'offers' => $offers,
        'offerCount' => $offerCount,
        // TODO: Use the session for this. See https://laravel.com/docs/10.x/session
        'filterParams' => $filterParams,
    ]);
});

Route::get('/fr/offers', function (Request $request) {
    App::setLocale('fr');
    $offers = get_offers_from_request($request);
    $offerCount = $offers->count();
    // TODO: Not so good, should be refactored too.
    $filterParams = OfferController::extractValidFilterParamsFromRequest(
        $request
    );

    return view('offers-list', [
        'offers' => $offers,
        'offerCount' => $offerCount,
        // TODO: Use the session for this. See https://laravel.com/docs/10.x/session
        'filterParams' => $filterParams,
    ]);
});

Route::get('/es/offers', function (Request $request) {
    App::setLocale('es');
    $offers = get_offers_from_request($request);
    $offerCount = $offers->count();
    // TODO: Not so good, should be refactored too.
    $filterParams = OfferController::extractValidFilterParamsFromRequest(
        $request
    );

    return view('offers-list', [
        'offers' => $offers,
        'offerCount' => $offerCount,
        // TODO: Use the session for this. See https://laravel.com/docs/10.x/session
        'filterParams' => $filterParams,
    ]);
});

Route::get('/it/offers', function (Request $request) {
    App::setLocale('it');
    $offers = get_offers_from_request($request);
    $offerCount = $offers->count();
    // TODO: Not so good, should be refactored too.
    $filterParams = OfferController::extractValidFilterParamsFromRequest(
        $request
    );

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
