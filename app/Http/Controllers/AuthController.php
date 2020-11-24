<?php

namespace App\Http\Controllers;

use App\Panitia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use  App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTException\Facades\JWTException;

class AuthController extends Controller
{
    public $loginAfterSignUp = true;

    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->guard = "api";
    }
    public function register(Request $request)
    {
        $user = User::create([
            'uuid' => Str::uuid(),
            'nama_panitia' => $request->nama_panitia,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'created_at' => DB::raw('now()')
        ]);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }
    public function login(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['username', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        return $this->respondWithToken($token);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 360
        ], 200);
    }
}
