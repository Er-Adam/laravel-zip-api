<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $cities = CityResource::collection(City::with('county')->get());
        return response()->json([
            "cities" => $cities,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request): JsonResponse
    {
        $city = City::create($request->all());

        return response()->json([
            "city" => $city,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $city = City::where('id', $id)->with('county')->first();
        $cityResource = new CityResource($city);

        return response()->json([
            "city" => $cityResource,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, string $id): JsonResponse
    {
        $city = City::findOrFail($id);
        $city->update($request->validated());

        return response()->json([
            "city" => $city,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json([
            'message' => 'City deleted successfully',
            'id' => $id
        ]);
    }
}
