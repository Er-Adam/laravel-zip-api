<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    function downloadCsv(Request $request)
    {
        if ($request->post('type') === null || $request->post('id') === null) {
            return redirect('/')
                ->with('redirect', true);
        }

        $id = $request->post('id');
        $type = $request->post('type');
        if ($type == 'city') $d = $this->getCityData($id, $request->post('countyId'));
        else if ($type == 'county') $d = $this->getCountyData($id);
        else return redirect('/')->with('redirect', true);

        $response = new StreamedResponse(function () use ($d) {
            $handle = fopen('php://output', 'w');

            foreach ($d['data'] as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $d['name'] . '.csv"');

        return $response;
    }

    function downloadPdf(Request $request)
    {
        if ($request->post('type') === null || $request->post('id') === null) {
            return redirect('/')
                ->with('redirect', true);
        }

        $id = $request->post('id');
        $type = $request->post('type');

        if ($type == 'city') $d = $this->getCityData($id, $request->post('countyId'));
        else if ($type == 'county') $d = $this->getCountyData($id);
        else return redirect('/')->with('redirect', true);

        $pdf = Pdf::loadView('pdf.table', [
            'title' => $d['name'],
            'data' => $d['data']
        ]);

        return $pdf->download($d['name'] . '.pdf');
    }

    private function getCityData($cityId, $countyId)
    {
        $cityName = Http::api()->get("city/$cityId")->json('city.name');
        $postalcodes = Http::api()->get("county/$countyId/city/$cityId/postalcode")->json('postalcodes');
        $data = [
            ['PostalCodeId', 'PostalCode']
        ];
        foreach ($postalcodes as $postalcode) {
            $data[] = [$postalcode['id'], $postalcode['postal_code']];
        }

        return [
            'name' => $cityName,
            'data' => $data
        ];
    }

    private function getCountyData($countyId)
    {
        $countyName = Http::api()->get("county/$countyId")->json('county.name');
        $cities = Http::api()->get("county/$countyId/city")->json('cities');
        $data = [
            ['CityId', 'CityName']
        ];
        foreach ($cities as $city) {
            $data[] = [$city['id'], $city['name']];
        }

        return [
            'name' => $countyName,
            'data' => $data
        ];
    }
}
