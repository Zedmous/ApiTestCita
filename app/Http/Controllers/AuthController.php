<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    /**
     * Instancia del repositorio UserRepository.
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     * AuthController instance.
     *
     * @param UserRepository $userRepository
	 *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        //$this->middleware('auth:api', ['except' => ['login']]);
        $this->middleware('jwt.verify', ['except' => ['login']]);
        $this->userRepository = $userRepository;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:4',
            //'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        //$request->status=true;
        $credentials = $request->only('username', 'password','status');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out'], Response::HTTP_NO_CONTENT);
        
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
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
    protected function respondWithToken($token)
    {
    
        $user = auth()->user();
    	/*$rolePermissions = $this->userRepository->getRolePermissions($user);
        $roles = $user->getRoleNames();*/
        //$user->load('profile');
        
        $data = [
            'user' => $user,
            /*'roles' => $rolePermissions['roles'],
            'permissions' => $rolePermissions['permissions'],*/
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 3000
        ];

        return response()->json(compact('data'));
    }
}
