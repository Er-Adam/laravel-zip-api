<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DeleteController extends Controller
{
    function delete(Request $request)
    {
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
    }
}
