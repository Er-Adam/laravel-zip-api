<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


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

Route::post('/user/login', [UserController::class, 'login']);
