<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountyController extends Controller
{
    function abc(Request $request){
        $countyId = $request->query('countyId');

        session(['countyId' => $countyId]);
        session()->forget('initial');

        return redirect('/')
            ->with('redirect', true);
    }

    function initial(Request $request){
        $initial = $request->query('initial');

        session(['initial' => $initial]);

        return redirect('/')
            ->with('redirect', true);
    }
}
