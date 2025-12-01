<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (!session()->has('redirect')) {
        session()->forget('initial');
        session()->forget('countyId');
        session()->forget('edit_type');
        session()->forget('edit_id');
    }

    return view('main');
});
Route::get("/county-abc", function (Request $request) {
    $countyId = $request->query('countyId');

    session(['countyId' => $countyId]);
    session()->forget('initial');

    return redirect('/')
        ->with('redirect', true);
});
Route::get('/county-initial', function (Request $request) {
    $initial = $request->query('initial');

    session(['initial' => $initial]);

    return redirect('/')
        ->with('redirect', true);
});


Route::post('delete', function (Request $request) {
    if (!session()->has('token') || $request->post('type') === null || $request->post('id') === null) {
        return redirect('/')
            ->with('redirect', true);
    }

    $id = $request->post('id');

    switch ($request->post('type')) {
        case "postalcode":
            Http::apiWithToken(session()->get('token'))->delete("/postalcode/$id");
            break;
        case 'city':
            Http::apiWithToken(session()->get('token'))->delete("/city/$id");
            break;
        case 'county':
            Http::apiWithToken(session()->get('token'))->delete("/county/$id");
            session()->forget('countyId');
            break;
    }

    return redirect('/')
        ->with('redirect', true);
})
    ->name('delete');


Route::post('start-edit', function (Request $request) {
    if (!session()->has('token') || $request->post('id') === null || $request->post('type') === null) {
        return redirect('/')
            ->with('redirect', true);
    }

    session()->forget('add_type');
    session()->forget('add_id');
    session(['edit_type' => $request->post('type')]);
    session(['edit_id' => $request->post('id')]);

    return redirect('/')
        ->with('redirect', true);
})
    ->name('start-edit');
Route::post('end-edit', function (Request $request) {
    if (!session()->has('token') || $request->post('id') === null || $request->post('type') === null || $request->post('value') === null) {
        return redirect('/')
            ->with('redirect', true);
    }

    session()->forget('edit_type');
    session()->forget('edit_id');

    $id = $request->post('id');
    $value = $request->post('value');

    switch ($request->post('type')) {
        case 'postalcode':
            Http::apiWithToken()->patch("/postalcode/$id", ['postal_code' => $value]);
            break;
        case 'city':
            Http::apiWithToken()->patch("/city/$id", ['name' => $value]);
            break;
        case 'county':
            Http::apiWithToken()->patch("/county/$id", ['name' => $value]);
            break;
    }

    return redirect('/')
        ->with('redirect', true);
})
    ->name('end-edit');
Route::post('stop-edit', function () {
    session()->forget('edit_type');
    session()->forget('edit_id');

    return redirect('/')
        ->with('redirect', true);
})
    ->name('stop-edit');


Route::post('start-add', function (Request $request) {
    if (!session()->has('token') || $request->post('id') === null || $request->post('type') === null) {
        return redirect('/')
            ->with('redirect', true);
    }

    session()->forget('edit_type');
    session()->forget('edit_id');
    session(['add_type' => $request->post('type')]);
    session(['add_id' => $request->post('id')]);

    return redirect('/')
        ->with('redirect', true);
})
    ->name('start-add');
Route::post('end-add', function (Request $request) {
    if (!session()->has('token') || $request->post('id') === null || $request->post('type') === null) {
        return redirect('/')
            ->with('redirect', true);
    }

    session()->forget('add_type');
    session()->forget('add_id');

    $id = $request->post('id');
    $type = $request->post('type');
    $value = $request->post('value');

    switch ($type) {
        case 'city':
            Http::apiWithToken()->post("/postalcode/", [
                'postal_code' => $value,
                'city_id' => $id
            ]);
            break;
    }

    return redirect('/')
        ->with('redirect', true);
})
    ->name('end-add');;
Route::post('stop-add', function () {
    session()->forget('add_type');
    session()->forget('add_id');

    return redirect('/')
        ->with('redirect', true);
})
    ->name('stop-add');


Route::get('login', [LoginController::class, 'show']);


require __DIR__ . '/auth.php';
