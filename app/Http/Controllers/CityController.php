<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    /**
     * @api {get} /city Get all cities
     * @apiName GetCities
     * @apiGroup City
     * @apiVersion 1.0.0
     *
     * @apiSuccess {Object[]} cities List of cities
     * @apiSuccess {Number} cities.id City ID
     * @apiSuccess {String} cities.name City name
     * @apiSuccess {Object} cities.county County information
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "cities": [
     *         {
     *           "id": 1,
     *           "name": "Amsterdam",
     *           "county": {
     *             "id": 1,
     *             "name": "Noord-Holland"
     *           }
     *         }
     *       ]
     *     }
     */
    public function index(): JsonResponse
    {
        $cities = CityResource::collection(City::with('county')->get());
        return response()->json([
            "cities" => $cities,
        ]);
    }

    /**
     * @api {post} /city Create a new city
     * @apiName CreateCity
     * @apiGroup City
     * @apiVersion 1.0.0
     *
     * @apiBody {String} name City name (required)
     * @apiBody {Number} county_id County ID (required)
     *
     * @apiParamExample {json} Request-Example:
     *     {
     *       "name": "Amsterdam",
     *       "county_id": 1
     *     }
     *
     * @apiSuccess {Object} city Created city
     * @apiSuccess {Number} city.id City ID
     * @apiSuccess {String} city.name City name
     * @apiSuccess {Object} city.county County information
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "city": {
     *         "id": 1,
     *         "name": "Amsterdam",
     *         "county": {
     *           "id": 1,
     *           "name": "Noord-Holland"
     *         }
     *       }
     *     }
     */
    public function store(CityRequest $request): JsonResponse
    {
        $city = City::create($request->validated());
        $cityResource = new CityResource($city);

        return response()->json([
            "city" => $cityResource,
        ]);
    }

    /**
     * @api {get} /city/:id Get a specific city
     * @apiName GetCity
     * @apiGroup City
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id City ID
     *
     * @apiSuccess {Object} city City information
     * @apiSuccess {Number} city.id City ID
     * @apiSuccess {String} city.name City name
     * @apiSuccess {Object} city.county County information
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "city": {
     *         "id": 1,
     *         "name": "Amsterdam",
     *         "county": {
     *           "id": 1,
     *           "name": "Noord-Holland"
     *         }
     *       }
     *     }
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
     * @api {patch} /city/:id Update a city
     * @apiName UpdateCity
     * @apiGroup City
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id City ID
     *
     * @apiBody {String} [name] City name
     * @apiBody {Number} [county_id] County ID
     *
     * @apiParamExample {json} Request-Example:
     *     {
     *       "name": "Rotterdam",
     *       "county_id": 2
     *     }
     *
     * @apiSuccess {Object} city Updated city
     * @apiSuccess {Number} city.id City ID
     * @apiSuccess {String} city.name City name
     * @apiSuccess {Object} city.county County information
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "city": {
     *         "id": 1,
     *         "name": "Rotterdam",
     *         "county": {
     *            "id": 2,
     *            "name": "Noord-Holland"
     *          }
     *       }
     *     }
     */
    public function update(CityRequest $request, string $id): JsonResponse
    {
        $city = City::findOrFail($id);
        $city->update($request->validated());
        $cityResource = new CityResource($city);

        return response()->json([
            "city" => $cityResource,
        ]);
    }

    /**
     * @api {delete} /city/:id Delete a city
     * @apiName DeleteCity
     * @apiGroup City
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id City ID
     *
     * @apiSuccess {String} message Success message
     * @apiSuccess {Number} id Deleted city ID
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "message": "City deleted successfully",
     *       "id": 1
     *     }
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
