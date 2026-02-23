<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\County;
use App\Models\PostalCode;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::all();
        return view("city.index", compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::all();
        return view("city.create", compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:25',
            'county_id' => 'required'
        ]);

        $city = new City();
        $city->name = $request->name;
        $city->county_id = $request->county_id;
        $city->save();

        // return redirect()->route('city.index')->with('success', 'Város sikeresen létrehozva');
        return back()->with('success', 'Város sikeresen létrehozva');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = City::find($id);
        $county = County::find($city->county_id);
        $postalcodes = PostalCode::where('city_id', $city->id)->get();
        return view('city.show',compact('city', 'county', 'postalcodes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = City::find($id);
        $counties = County::all();
        return view('city.edit',compact('city', 'counties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:25',
            'county_id' => 'required'
        ]);

        $city = City::find($id);
        $city->name = $request->name;
        $city->county_id = $request->county_id;
        $city->save();

        // return redirect()->route('city.index')->with('success', 'Város sikeresen módosítva');
        return back()->with('success', 'Város sikeresen módosítva');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::find($id);
        $city->delete();

        return back()->with('success', 'Város sikeresen törölve');
        // redirect()->route('city.index')->with('success', 'Város sikeresen törölve');
    }
}
