<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EditController extends Controller
{
    function start(Request $request)
    {
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
    }

    function end(Request $request)
    {
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
    }

    function stop(Request $request)
    {
        session()->forget('edit_type');
        session()->forget('edit_id');

        return redirect('/')
            ->with('redirect', true);
    }
}
