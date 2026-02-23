<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function login(Request $request)
    {
        session(["user" => 'admin']);

        return back();
    }

    function logout(Request $request){

        session()->forget('user');

        return back();
    }
}
