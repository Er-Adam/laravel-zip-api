<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    function loadMainView()
    {
        if (!session()->has('redirect')) {
            session()->forget('initial');
            session()->forget('countyId');
            session()->forget('edit_type');
            session()->forget('edit_id');
        }

        return view('main');
    }
}
