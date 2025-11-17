<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if(!session()->has('redirect')){
        session()->forget('cityId');
        session()->forget('initial');
        session()->forget('countyId');
    }

    return view('main');
});

Route::get("/county-abc", function (Request $request) {
    $countyId = $request->query('countyId');

    session(['countyId' => $countyId]);
    session()->forget('initial');
    session()->forget('cityId');

    return redirect('/')
        ->with('redirect', true);
});

Route::get('/county-initial', function (Request $request) {
    $initial = $request->query('initial');

    session(['initial' => $initial]);
    session()->forget('cityId');

    return redirect('/')
        ->with('redirect', true);
});

Route::get('/city', function (Request $request) {
    $cityId = $request->query('cityId');

    session(['cityId' => $cityId]);

    return redirect('/')
        ->with('redirect', true);
});


Route::get('login', [LoginController::class, 'show']);
Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

require __DIR__ . '/auth.php';
