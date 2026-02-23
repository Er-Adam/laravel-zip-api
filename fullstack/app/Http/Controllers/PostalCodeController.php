<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\County;
use App\Models\PostalCode;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postalcodes = PostalCode::all();
        return view("postalcode.index", compact('postalcodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view("postalcode.create", compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'postal_code' => 'required',
            'city_id' => 'required'
        ]);

        $postalcode= new PostalCode();
        $postalcode->name = $request->name;
        $postalcode->city_id = $request->city_id;
        $postalcode->save();

        return redirect()->route('postalcode.index')->with('success', 'Zipkód sikeresen létrehozva');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $postalcode = PostalCode::find($id);
        $city = City::find($postalcode->city_id);
        $county = County::find($city->county_id);
        return view('postalcode.show',compact('postalcode', 'city', 'county'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $postalcode = PostalCode::find($id);
        $cities = City::all();
        return view('postalcode.edit',compact('postalcode', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'postal_code' => 'required',
            'city_id' => 'required'
        ]);


        $postalcode = PostalCode::find($id);
        $postalcode->postal_code = $request->postal_code;
        $postalcode->city_id = $request->city_id;
        $postalcode->save();

        return redirect()->route('postalcode.index')->with('success', 'Zipkód sikeresen módosítva');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $postalcode = PostalCode::find($id);
        $postalcode->delete();

        return redirect()->route('postalcode.index')->with('success', 'Zipkód sikeresen törölve');
    }
}
