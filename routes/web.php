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
    return view('home');
});

Route::get('/offers', function (Request $request) {
    $offers = OfferRepository::getFreeOffers()->paginate(25);
    return view('offers-list', [
        'offers' => $offers,
    ]);
});

Route::get('/offers/{offer}', [OfferController::class, 'show']);
