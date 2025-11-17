<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get("/county/{countyId}/city", [CityController::class, "indexWithCounty"]);
Route::get("/county/{countyId}/city/{cityId}", [CityController::class, "showWithCounty"]);
Route::get("/county/{countyId}/abc", [CityController::class, "indexWithCountyAbc"]);
Route::get("/county/{countyId}/abc/{initial}", [CityController::class, "showWithCountyByAbc"]);

Route::get("county/{countyId}/city/{cityId}/postalcode", [PostalCodeController::class, "indexWithCity"]);
Route::get("county/{countyId}/city/{cityId}/postalcode/{postalcodeId}", [PostalCodeController::class, "showWithCity"]);


Route::get("/county", [CountyController::class, "index"]);
Route::get("/county/{id}", [CountyController::class, "show"]);
Route::post('/county', [CountyController::class, 'store'])->middleware('auth:sanctum');
Route::patch("/county/{id}", [CountyController::class, "update"])->middleware('auth:sanctum');
Route::delete("/county/{id}", [CountyController::class, "destroy"])->middleware('auth:sanctum');

Route::get("/city", [CityController::class, "index"]);
Route::get("/city/{id}", [CityController::class, "show"]);
Route::post('/city', [CityController::class, 'store'])->middleware('auth:sanctum');
Route::patch("/city/{id}", [CityController::class, "update"])->middleware('auth:sanctum');
Route::delete("/city/{id}", [CityController::class, "destroy"])->middleware('auth:sanctum');

Route::get("/postalcode", [PostalCodeController::class, "index"]);
Route::get("/postalcode/{id}", [PostalCodeController::class, "show"]);
Route::post('/postalcode', [PostalCodeController::class, 'store'])->middleware('auth:sanctum');
Route::patch('/postalcode/{id}', [PostalCodeController::class, 'update'])->middleware('auth:sanctum');
Route::delete("/postalcode/{id}", [PostalCodeController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('/user/login', [UserController::class, 'login']);
