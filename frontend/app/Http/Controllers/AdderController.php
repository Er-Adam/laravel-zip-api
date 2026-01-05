<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdderController extends Controller
{
    function start(Request $request)
    {
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
    }

    function end(Request $request)
    {
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
            case 'postalcode':
                Http::apiWithToken()->post("/postalcode/", ['postal_code' => $value, 'city_id' => $id]);
                break;
            case 'city':
                Http::apiWithToken()->post("/city/", ['name' => $value, 'county_id' => $id]);
                break;
            case 'county':
                $res = Http::apiWithToken()->post("/county/", ['name' => $value,]);

                $countyId = $res->json('county.id');
                session(['countyId' => $countyId]);
                break;
        }

        return redirect('/')
            ->with('redirect', true);
    }

    function stop(Request $request)
    {
        session()->forget('add_type');
        session()->forget('add_id');

        return redirect('/')
            ->with('redirect', true);
    }

}
