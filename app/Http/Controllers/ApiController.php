<?php

namespace App\Http\Controllers;

use App\Models\AdminRoleUser;
use App\Models\User;
use App\Models\Utils;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        header('Content-Type: application/json');

        $requestUrl = request()->path();
        $segments = explode('/', $requestUrl);
        $lastSegment = end($segments);

        if ($lastSegment != 'login' && $lastSegment != 'register') {
            $u = auth('api')->user();
            if ($u == null) {
                die(json_encode(['code' => 0, 'message' => 'Unauthorized']));
            }
        }
        // die("my api");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        die('test');
    }
    public function profile()
    {
        $u = auth('api')->user();
        if ($u == null) {
            return Utils::apiError('Unauthorized');
        }
        return Utils::apiSuccess($u);
    }

    
    public function register(Request $request)
    {
        $rules = [
            'last_name' => 'required',
            'first_name' => 'required',
            'username' => 'required|unique:admin_users',
            'email' => 'required|email|unique:admin_users',
            'password' => 'required',
        ];


        try {
            // Validate the incoming request data
            $validatedData = Validator::make($request->all(), $rules)->validate();
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        $user = User::create([
            'first_name' => $validatedData[ 'first_name'],
            'last_name'  => $validatedData[ 'last_name'] ,          
            'username' => $validatedData['username'],
            'name' => $validatedData[ 'first_name'] . ' ' . $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
           
        ]);
        $token = JWTAuth::fromUser($user);

            return response()->json([
                'user' => $user,
                'token' => $token
            ], 201);
    }

    public function login(Request $r)
    {

        if ($r->username == null) {
            return Utils::apiError('Username is required.');
        }
        if ($r->password == null) {
            return Utils::apiError('Password is required.');
        }
        $u = Administrator::where('username', $r->username)
        ->with('roles') // Assuming 'role' is the name of the relationship in your User model
        ->first();
        if ($u == null) {
            return Utils::apiError('User account not found.');
        }


        JWTAuth::factory()->setTTL(60 * 24 * 30 * 12);
        $token = auth('api')->attempt([
            'username' => $u->username,
            'password' => $r->password,
        ]);

        if ($token == null) {
            return Utils::apiError('Invalid credentials.');
        }
        $u->token = $token;
        return Utils::apiSuccess($u, 'User logged in successfully.');
    }
}
