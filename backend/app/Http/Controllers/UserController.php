<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @api {post} /login User login
     * @apiName UserLogin
     * @apiGroup User
     * @apiVersion 1.0.0
     *
     * @apiBody {String} email User email address (required)
     * @apiBody {String} password User password (required)
     *
     * @apiParamExample {json} Request-Example:
     *     {
     *       "email": "user@example.com",
     *       "password": "password123"
     *     }
     *
     * @apiSuccess {Object} user User information
     * @apiSuccess {Number} user.id User ID
     * @apiSuccess {String} user.name User name
     * @apiSuccess {String} user.email User email
     * @apiSuccess {String} token Authentication token
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "user": {
     *         "id": 1,
     *         "name": "John Doe",
     *         "email": "user@example.com"
     *       },
     *       "token": "1|abcdefghijklmnopqrstuvwxyz"
     *     }
     *
     * @apiError {String} message Error message
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 401 Unauthorized
     *     {
     *       "message": "Invalid email or password"
     *     }
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid email or password',
            ], 401);
        }

        // revoke old tokens
        $user->tokens()->delete();

        // create new token
        $token = $user->createToken('access')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

}
