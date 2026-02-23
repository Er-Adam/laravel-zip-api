<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\County;
use Illuminate\Http\Request;

class AbcController extends Controller
{
    public function firstVisit()
    {
        $counties = County::all();
        return view("abc.index", compact('counties'));
    }

    public function countySelected(Request $request)
    {
        $request->validate([
            "countyId" => "required",
        ]);

        $county = County::find($request->countyId);
        $initials = City::where('county_id', $county->id)
            ->selectRaw("UPPER(SUBSTRING(name, 1, 1)) as initial")
            ->distinct()
            ->orderBy('initial')
            ->pluck('initial');;

        return view("abc.county", compact('county', 'initials'));
    }

    public function initialSelected(Request $request)
    {
        $initial = $request->initial;
        $county = County::find($request->countyId);
        
        $cities = City::where('county_id', $county->id)
            ->whereRaw('UPPER(substr(name, 1, 1)) = ?', [strtoupper($initial)])
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('abc.initial', compact('cities', 'county', 'initial'));
    }

    public function deleteCity(Request $request)
    {
        $city = City::find($request->id);
        $city->delete();
        

        $initial = substr($city->name, 0,1);
        $county = County::find($city->county_id);
        
        $cities = City::where('county_id', $county->id)
            ->whereRaw('UPPER(substr(name, 1, 1)) = ?', [strtoupper($initial)])
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('abc.initial', compact('cities'))->with('success', 'Város sikeresen törölve');
    }
}
