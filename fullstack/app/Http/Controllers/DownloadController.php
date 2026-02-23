<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\County;
use App\Models\PostalCode;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\CitiesExportMail;

class DownloadController extends Controller
{
    function downloadCsv(Request $request)
    {
        $countyId = $request->county_id;
        $initial = $request->initial;

        $county = County::find($countyId);
        $cities = City::where('county_id', $county->id)
            ->whereRaw('UPPER(substr(name, 1, 1)) = ?', [strtoupper($initial)])
            ->orderBy('name')
            ->get(['id', 'name']);

        $fileName = 'cities.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function () use ($county, $cities) {
            $file = fopen('php://output', 'w');


            // Header row
            fputcsv($file, ['County', 'City', 'Postal Codes']);

            foreach ($cities as $city) {
                $codes = PostalCode::where('city_id', $city->id)
                    ->pluck('postal_code')
                    ->toArray();

                foreach($codes as $code){
                    fputcsv($file, [
                        $county->name,
                        $city->name,
                        $code
                    ]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function downloadPdf(Request $request)
    {
        $countyId = $request->county_id;
        $initial = $request->initial;

        $county = County::findOrFail($countyId);

        $cities = City::where('county_id', $county->id)
            ->whereRaw('UPPER(substr(name, 1, 1)) = ?', [strtoupper($initial)])
            ->orderBy('name')
            ->get(['id', 'name']);

        $data = [];

        foreach ($cities as $city) {
            $codes = PostalCode::where('city_id', $city->id)
                ->pluck('postal_code')
                ->toArray();

            foreach($codes as $code){
                $data[] = [
                    'county' => $county->name,
                    'city' => $city->name,
                    'code' => $code
                ];
            }
        }

        $pdf = Pdf::loadView('download.cities', compact('data'));

        return $pdf->download('cities.pdf');
    }

    public function sendEmail(Request $request)
    {
        $county = County::findOrFail($request->county_id);
        $initial = $request->initial;
        $email = $request->email;

        $cities = City::where('county_id', $county->id)
            ->whereRaw('UPPER(substr(name, 1, 1)) = ?', [strtoupper($initial)])
            ->orderBy('name')
            ->get(['id', 'name']);

        $data = [];

        foreach ($cities as $city) {
            $codes = PostalCode::where('city_id', $city->id)
                ->pluck('postal_code')
                ->toArray();

            foreach($codes as $code)
            {
                $data[] = [
                    'county' => $county->name,
                    'city' => $city->name,
                    'code' => $code
                ];
            }
        }

        Mail::to($email)->send(
            new CitiesExportMail($data)
        );

        return back()->with('success', 'Email sent!');
    }
}