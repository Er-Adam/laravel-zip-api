<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostalCodeRequest;
use App\Http\Resources\PostalCodeResource;
use App\Models\PostalCode;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    /**
     * @api {get} /postalcode Get all postal codes
     * @apiName GetPostalCodes
     * @apiGroup PostalCode
     * @apiVersion 1.0.0
     *
     * @apiSuccess {Object[]} postalCodes List of postal codes
     * @apiSuccess {Number} postalCodes.id Postal code ID
     * @apiSuccess {String} postalCodes.postal_code Postal code
     * @apiSuccess {Object} postalCodes.city City information
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "postalCodes": [
     *         {
     *           "id": 1,
     *           "postal_code": 1012,
     *           "city": {
     *             "id": 1,
     *             "name": "Amsterdam"
     *           }
     *         }
     *       ]
     *     }
     */
    public function index()
    {
        $postalCodes = PostalCodeResource::collection(PostalCode::with('city')->get());
        return response()->json([
            "postalCodes" => $postalCodes,
        ]);
    }

    /**
     * @api {post} /postalcode Create a new postal code
     * @apiName CreatePostalCode
     * @apiGroup PostalCode
     * @apiVersion 1.0.0
     *
     * @apiBody {Number} code Postal code (required)
     * @apiBody {Number} city_id City ID (required)
     *
     * @apiParamExample {json} Request-Example:
     *     {
     *       "postal_code": 1012,
     *       "city_id": 1
     *     }
     *
     * @apiSuccess {Object} postalcode Created postal code
     * @apiSuccess {Number} postalcode.id Postal code ID
     * @apiSuccess {Number} postalcode.postal_code Postal code
     * @apiSuccess {Number} postalcode.city City information
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "postalcode": {
     *         "id": 1,
     *         "postal_code": 1012,
     *         "city":{
     *           "id": 1,
     *           "name": "Amsterdam"
     *         }
     *       }
     *     }
     */
    public function store(PostalCodeRequest $request)
    {
        $postalcode = PostalCode::create($request->validated());
        $postalcodeResource = new PostalCodeResource($postalcode);

        return response()->json([
            "postalcode" => $postalcodeResource,
        ]);
    }

    /**
     * @api {get} /postalcode/:id Get a specific postal code
     * @apiName GetPostalCode
     * @apiGroup PostalCode
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id Postal code ID
     *
     * @apiSuccess {Object} postalcode Postal code information
     * @apiSuccess {Number} postalcode.id Postal code ID
     * @apiSuccess {Number} postalcode.postal_code Postal code
     * @apiSuccess {Object} postalcode.city City information
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "postalcode": {
     *         "id": 1,
     *         "postal_code": 1012,
     *         "city": {
     *           "id": 1,
     *           "name": "Amsterdam"
     *         }
     *       }
     *     }
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
     * @api {patch} /postalcode/:id Update a postal code
     * @apiName UpdatePostalCode
     * @apiGroup PostalCode
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id Postal code ID
     * @apiBody {Number} [postal_code] Postal code
     * @apiBody {Number} [city_id] City ID
     *
     * @apiParamExample {json} Request-Example:
     *     {
     *       "postal_code": 1013,
     *       "city_id": 2
     *     }
     *
     * @apiSuccess {Object} postalcode Updated postal code
     * @apiSuccess {Number} postalcode.id Postal code ID
     * @apiSuccess {Number} postalcode.postal_code Postal code
     * @apiSuccess {Number} postalcode.city City information
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "postalcode": {
     *         "id": 1,
     *         "postal_code": 1013,
     *         "city":{
     *             "id": 2",
     *             "name": "Rotterdam"
     *         }
     *       }
     *     }
     */
    public function update(PostalCodeRequest $request, string $id)
    {
        $postalcode = PostalCode::findOrFail($id);
        $postalcode->update($request->validated());
        $postalcodeResource = new PostalCodeResource($postalcode);

        return response()->json([
            "postalcode" => $postalcodeResource,
        ]);
    }

    /**
     * @api {delete} /postalcode/:id Delete a postal code
     * @apiName DeletePostalCode
     * @apiGroup PostalCode
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id Postal code ID
     *
     * @apiSuccess {String} message Success message
     * @apiSuccess {Number} id Deleted postal code ID
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "message": "Postalcode deleted successfully",
     *       "id": 1
     *     }
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
