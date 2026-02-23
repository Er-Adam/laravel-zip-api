<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\AbcController;
use App\Http\Controllers\DownloadController;

Route::get('/', function () {
    return redirect('/abc');
});

Route::get('abc/', [AbcController::class, 'firstVisit'])->name('abc-first');
Route::get('abc/county', [AbcController::class, 'countySelected'])->name('abc-county');
Route::get('abc/initial', [AbcController::class, 'initialSelected'])->name('abc-initial');
Route::get('abc/delete', [AbcController::class, 'deleteCity'])->name('abc-delete');

Route::get('download/csv', [DownloadController::class, 'downloadCsv'])->name('download-csv');
Route::get('download/pdf', [DownloadController::class, 'downloadPdf'])->name('download-pdf');
Route::post('send/email', [DownloadController::class, 'sendEmail'])->name('send-email');

Route::resource('county', CountyController::class);
Route::resource('city', CityController::class);
Route::resource('postalcode', PostalCodeController::class);