<?php

namespace App\Http\Controllers;

use App\Mail\DataMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    function send(Request $request)
    {
        if ($request->post('type') === null || $request->post('id') === null || !session()->has('user_email')) {
            return redirect('/')
                ->with('redirect', true);
        }

        $id = $request->post('id');

        switch ($request->post('type')) {
            case 'city':
                $cityName = Http::api()->get("city/$id")->json('city.name');
                $subjectType = "$cityName city";
                $title = "$cityName";
                $countyId = $request->post('countyId');
                $postalcodes = Http::api()->get("county/$countyId/city/$id/postalcode")->json('postalcodes');
                $data = [
                    ['PostalCodeId', 'PostalCode']
                ];
                foreach ($postalcodes as $postalcode) {
                    $data[] = [$postalcode['id'], $postalcode['postal_code']];
                }
                break;
            case 'county':
                $countyName = Http::api()->get("county/$id")->json('county.name');
                $subjectType = "$countyName county";
                $title = "$countyName";
                $cities = Http::api()->get("county/$id/city")->json('cities');
                $data = [
                    ['CityId', 'CityName']
                ];
                foreach ($cities as $city) {
                    $data[] = [$city['id'], $city['name']];
                }
                break;
            default:
                return redirect('/')
                    ->with('redirect', true);
        }

        Mail::to(session()->get("user_email"))->send(new DataMail($subjectType, [
            'title' => $title,
            'data' => $data
        ]));

        return redirect('/')
            ->with('redirect', true);
    }
}
