<?php

namespace App\Http\Controllers;

use App\Models\AdminRoleUser;
use App\Models\User;
use App\Models\Utils;
use Dflydev\DotAccessData\Util;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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
    public function me()
    {
        $u = auth('api')->user();
        if ($u == null) {
            return Utils::apiError('Unauthorized');
        }
        return Utils::apiSuccess($u);
    }

  
    public function register(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
    
        if ($validator->fails()) {
            return Utils::apiError($validator->errors()->first());
        }
    
        // Create and save the new user
        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->username = $request->input('username'); // Assuming username is the same as email
            $user->password = Hash::make($request->input('password'));
            $user->save();
            
            // Assign a default role to the user (e.g., AdminRoleUser with ID 3)
            $role = new AdminRoleUser();
            $role->user_id = $user->id;
            $role->role_id = 3;
            $role->save();
        } catch (\Throwable $th) {
            return Utils::apiError('Error saving user. ' . $th->getMessage());
        }
    
        // Generate JWT token and attach it to the user object
        JWTAuth::factory()->setTTL(60 * 24 * 30 * 12);
        $token = auth('api')->attempt([
            'email' => $user->email,
            'password' => $request->input('password'),
        ]);
        $user->token = $token;
    
        return Utils::apiSuccess($user, 'User registered successfully.');
    }

    public function login(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return Utils::apiError($validator->errors()->first());
        }
    
        // Check if the user exists
        $user = User::where('email', $request->input('email'))->first();
    
        if (!$user) {
            return Utils::apiError('User not found.');
        }
    
        // Verify the user's password
        if (!Hash::check($request->input('password'), $user->password)) {
            return Utils::apiError('Invalid credentials.');
        }
    
        // Generate JWT token and attach it to the user object
        JWTAuth::factory()->setTTL(60 * 24 * 30 * 12);
        $token = auth('api')->attempt([
            'email' => $user->email,
            'password' => $request->input('password'),
        ]);
        $user->token = $token;
    
        return Utils::apiSuccess($user, 'Login successful.');
    }
}
