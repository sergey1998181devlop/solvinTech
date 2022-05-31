<?php namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'registration']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(){
        $credentials = request(['email', 'password']);

        if(!$token = auth()->attempt($credentials)){
            return response()->json(['error' => 'Incorrect email/password'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * User registration
     */
    public function registration(UserRequest $userRequest): \Illuminate\Http\JsonResponse
    {

        $user = new User();
        $data = $userRequest->input();
        $data['password'] = Hash::make( $data['password']);
        $res = $user->create($data);
        if($res){
            return response()->json(['message' => $res->name.' - Successfully registration!']);
        }else{
            return response()->json(['message' => 'Error registration']);
        }


    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(): \Illuminate\Http\JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
