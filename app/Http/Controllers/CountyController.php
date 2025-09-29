<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountyRequest;
use App\Models\County;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    public function index(): JsonResponse
    {
        $counties = County::all();
        return response()->json([
            "counties" => $counties,
        ]);
    }

    public function show($id): JsonResponse
    {
        $county = County::where('id', $id)->first();
        return response()->json([
            "county" => $county,
        ]);
    }

    public function store(CountyRequest $request){
        $county = County::create($request->all());

        return response()->json([
            'county' => $county,
        ]);
    }

    public function update(CountyRequest $request, $id){
        $county = County::findOrFail($id);
        $county->update($request->all());

        return response()->json([
            'county' => $county,
        ]);
    }

    public function destroy($id){
        $county = County::findOrFail($id);
        $county->delete();

        return response()->json([
            'message' => 'County deleted successfully',
            'id' => $id
        ]);
    }
}
