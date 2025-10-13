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
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "cities": [
     *         {
     *           "id": 1,
     *           "name": "Amsterdam",
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
     * @api {get} county/:countyId/city Get all cities
     * @apiName GetCities
     * @apiGroup City
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} countyId County ID
     *
     * @apiSuccess {Object[]} cities List of cities
     * @apiSuccess {Number} cities.id City ID
     * @apiSuccess {String} cities.name City name
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "cities": [
     *         {
     *           "id": 1,
     *           "name": "Amsterdam",
     *         }
     *       ]
     *     }
     */
    public function indexWithCounty(string $countyId): JsonResponse
    {
        $cities = City::where('county_id', $countyId)->get();
        $cityResources = CityResource::collection($cities);

        return response()->json([
            "cities" => $cityResources,
        ]);
    }

    /**
     * @api {get} county/:countyId/abc Get all city initials
     * @apiName GetCities
     * @apiGroup City
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} countyId County ID
     *
     * @apiSuccess {String[]} initials List of city initials
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "initials": [
     *         "A",
     *         "B",
     *         "C"
     *       ]
     *     }
     */
    public function indexWithCountyAbc(string $countyId): JsonResponse
    {
        $abc = City::where('county_id', $countyId)
            ->selectRaw("UPPER(SUBSTRING(name, 1, 1)) as initial")
            ->distinct()
            ->orderBy('initial')
            ->pluck('initial');;

        return response()->json([
            "initials" => $abc,
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
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "city": {
     *         "id": 1,
     *         "name": "Amsterdam",
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
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "city": {
     *         "id": 1,
     *         "name": "Amsterdam",
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
     * @api {get} county/:countyId/city/:id Get a specific city
     * @apiName GetCity
     * @apiGroup City
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} countyId County ID
     * @apiParam {Number} id City ID
     *
     * @apiSuccess {Object} city City information
     * @apiSuccess {Number} city.id City ID
     * @apiSuccess {String} city.name City name
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "city": {
     *         "id": 1,
     *         "name": "Amsterdam",
     *       }
     *     }
     */
    public function showWithCounty(string $countyId, string $cityId): JsonResponse
    {
        $city = City::where('id', $cityId)->where('county_id', $countyId)->first();
        $cityResource = new CityResource($city, true);

        return response()->json([
            "city" => $cityResource,
        ]);
    }

    /**
     * @api {get} county/:countyId/abc/:initial Get a cities by initial
     * @apiName GetCity
     * @apiGroup City
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} countyId County ID
     * @apiParam {Number} initial City's initial
     *
     * @apiSuccess {Object[]} cities List of cities
     * @apiSuccess {Number} city.id City ID
     * @apiSuccess {String} city.name City name
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "city": {
     *         "id": 1,
     *         "name": "Amsterdam",
     *       }
     *     }
     */
    public function showWithCountyByAbc(string $countyId, string $initial): JsonResponse
    {
        $cities = City::where('county_id', $countyId)
            ->whereRaw('UPPER(LEFT(name, 1)) = ?', [strtoupper($initial)])
            ->orderBy('name')
            ->get(['id', 'name']);
        $cityResources = CityResource::collection($cities);

        return response()->json([
            'cities' => $cityResources,
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
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "city": {
     *         "id": 1,
     *         "name": "Rotterdam",
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
    public function destroy(string $id): JsonResponse
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json([
            'message' => 'City deleted successfully',
            'id' => $id
        ]);
    }
}
