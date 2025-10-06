<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountyRequest;
use App\Models\County;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    /**
     * @api {get} /api/county Get all counties
     * @apiName GetCounties
     * @apiGroup County
     * @apiVersion 1.0.0
     *
     * @apiSuccess {Object[]} counties List of counties
     * @apiSuccess {Number} county.id County ID
     * @apiSuccess {String} county.name County name
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "counties": [
     *         {
     *           "id": 1,
     *           "name": "Noord-Holland"
     *         }
     *       ]
     *     }
     */
    public function index(): JsonResponse
    {
        $counties = County::all();
        return response()->json([
            "counties" => $counties,
        ]);
    }

    /**
     * @api {get} /api/county/:id Get a specific county
     * @apiName GetCounty
     * @apiGroup County
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id County ID
     *
     * @apiSuccess {Object} county County information
     * @apiSuccess {Number} county.id County ID
     * @apiSuccess {String} county.name County name
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "county": {
     *         "id": 1,
     *         "name": "Noord-Holland"
     *       }
     *     }
     */
    public function show($id): JsonResponse
    {
        $county = County::where('id', $id)->first();
        return response()->json([
            "county" => $county,
        ]);
    }

    /**
     * @api {post} /api/county Create a new county
     * @apiName CreateCounty
     * @apiGroup County
     * @apiVersion 1.0.0
     *
     * @apiParam (body) {String} name County name (required)
     *
     * @apiParamExample {json} Request-Example:
     *     {
     *       "name": "Noord-Holland"
     *     }
     *
     * @apiSuccess {Object} county Created county
     * @apiSuccess {Number} county.id County ID
     * @apiSuccess {String} county.name County name
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "county": {
     *         "id": 1,
     *         "name": "Noord-Holland"
     *       }
     *     }
     */
    public function store(CountyRequest $request){
        $county = County::create($request->validated());

        return response()->json([
            'county' => $county,
        ]);
    }

    /**
     * @api {patch} /api/county/:id Update a county
     * @apiName UpdateCounty
     * @apiGroup County
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id County ID
     * @apiParam (body) {String} [name] County name
     *
     * @apiParamExample {json} Request-Example:
     *     {
     *       "name": "Zuid-Holland"
     *     }
     *
     * @apiSuccess {Object} county Updated county
     * @apiSuccess {Number} county.id County ID
     * @apiSuccess {String} county.name County name
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "county": {
     *         "id": 1,
     *         "name": "Zuid-Holland"
     *       }
     *     }
     */
    public function update(CountyRequest $request, $id){
        $county = County::findOrFail($id);
        $county->update($request->validated());

        return response()->json([
            'county' => $county,
        ]);
    }

    /**
     * @api {delete} /api/county/:id Delete a county
     * @apiName DeleteCounty
     * @apiGroup County
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id County ID
     *
     * @apiSuccess {String} message Success message
     * @apiSuccess {Number} id Deleted county ID
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "message": "County deleted successfully",
     *       "id": 1
     *     }
     */
    public function destroy($id){
        $county = County::findOrFail($id);
        $county->delete();

        return response()->json([
            'message' => 'County deleted successfully',
            'id' => $id
        ]);
    }
}
