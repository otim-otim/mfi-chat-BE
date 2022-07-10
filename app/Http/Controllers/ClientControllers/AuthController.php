<?php

namespace App\Http\Controllers\ClientControllers;
use JWTAuth;
use App\Models\Borrower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt-verify', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['phone', 'password']);
        // dd($credentials);
        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $access_token = $this->respondWithToken($token);
        $borrower = Borrower::where('phone',request()->phone)->first();
        // dd($borrower);
        // dd(auth('api')->login($borrower));
        return response()->json([
            'borrower' => $borrower,
            'access_token'=> $access_token,
        ]);

       
    }

    public function register(Request $request){
        if($request){
            $borrower = new Borrower();
            $borrower->fname = $request->fname;
            $borrower->lname = $request->lname;
            $borrower->email = $request->email;
            $borrower->phone = $request->phone;
            $borrower->password = bcrypt($request->password);
            $borrower->save();
            if($borrower){
                return redirect()->route('client.login');
            }
        }
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
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
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
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
