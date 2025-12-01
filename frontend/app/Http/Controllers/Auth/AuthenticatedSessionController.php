<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $response = Http::api()->post('/user/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $token = $response['token'];
            $user = $response['user'];

            session([
                'token' => $token,
                'user_name' => $user['name'],
                'user_email' => $user['email'],
            ]);
        }

        return redirect()->intended('/');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget(['api_token', 'user_name', 'user_email']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
