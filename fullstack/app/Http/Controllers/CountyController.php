<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counties = County::all();
        return view("county.index", compact('counties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("county.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:25'
        ]);

        $county = new County();
        $county ->name = $request->name;
        $county ->save();

        return redirect()->route('county.index')->with('success', 'Megye sikeresen létrehozva');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $county = County::find($id);
        return view('county.show',compact('county'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $county = County::find($id);
        return view('county.edit',compact('county'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:25',
        ]);

        $county = County::find($id);
        $county->name = $request->name;
        $county->save();

        return redirect()->route('county.index')->with('success', 'Megye sikeresen módosítva');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $county = County::find($id);
        $county->delete();

        return redirect()->route('county.index')->with('success', 'Megye sikeresen törölve');
    }
}
