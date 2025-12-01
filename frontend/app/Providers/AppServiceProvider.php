<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Http::macro('api', function () {
            return Http::withHeaders([
                'Accept' => 'application/json',
            ])->baseUrl(config('services.api_base_url'));
        });

        Http::macro('apiWithToken', function (string $token = null) {
            $token = $token ?? session('token');

            return Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => $token ? "Bearer $token" : null,
            ])->baseUrl(config('services.api_base_url'));
        });

        Http::macro('isAuth', function () {
            $sess = session();
            return $sess->has('token') &&
                $sess->has('user_name') &&
                $sess->has('user_email');
        });

        Blade::if('isAuth', function () {
            $sess = session();
            return $sess->has('token') &&
                $sess->has('user_name') &&
                $sess->has('user_email');
        });
    }
}
