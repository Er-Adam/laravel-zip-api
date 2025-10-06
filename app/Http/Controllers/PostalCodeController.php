<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostalCodeRequest;
use App\Http\Resources\PostalCodeResource;
use App\Models\PostalCode;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postalCodes = PostalCodeResource::collection(PostalCode::with('city')->get());
        return response()->json([
            "postalCodes" => $postalCodes,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PostalCodeRequest $request)
    {
        $postalcode = PostalCode::create($request->validated());

        return response()->json([
            "postalcode" => $postalcode,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $postalcode = PostalCode::where('id', $id)->with('city')->first();
        $postalcodeResource = new PostalCodeResource($postalcode);

        return response()->json([
            "postalcode" => $postalcodeResource,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PostalCodeRequest $request, string $id)
    {
        $postalcode = PostalCode::findOrFail($id);
        $postalcode->update($request->validated());

        return response()->json([
            "postalcode" => $postalcode,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $postalcode = PostalCode::findOrFail($id);
        $postalcode->delete();

        return response()->json([
            'message' => 'Postalcode deleted successfully',
            'id' => $id
        ]);
    }
}
