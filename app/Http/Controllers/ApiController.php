<?php

namespace App\Http\Controllers;

use App\Models\AdminRoleUser;
use App\Models\Crop;
use App\Models\CropDeclaration;
use App\Models\CropVariety;
use App\Models\FieldInspection;
use App\Models\SeedProducer;
use App\Models\User;
use App\Models\Utils;
use Dflydev\DotAccessData\Util;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

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
    public function me()
    {
        $u = auth('api')->user();
        if ($u == null) {
            return Utils::apiError('Unauthorized');
        }
        return Utils::apiSuccess($u);
    }

    
    public function register(Request $r)
    {
        if ($r->name == null) {
            return Utils::apiError('Name is required.');
        }
        if ($r->email == null) {
            return Utils::apiError('Email is required.');
        }
        if ($r->password == null) {
            return Utils::apiError('Password is required.');
        }
        $u = User::where('email', $r->email)
            ->orWhere('username', $r->email)
            ->first();
        if ($u != null) {
            return Utils::apiError('Email already exists.');
        }
        $u = new User();
        $u->name = $r->name;
        $u->email = $r->email;
        $u->username = $r->email;
        $u->password = password_hash($r->password, PASSWORD_DEFAULT);
        try {
            $u->save();
            $role = new AdminRoleUser();
            $role->user_id = $u->id;
            $role->role_id = 3;
            $role->save();
        } catch (\Throwable $th) {
            return Utils::apiError('Error saving user. ' . $th->getMessage());
        }

        $u = User::where('email', $r->email)->first();

        JWTAuth::factory()->setTTL(60 * 24 * 30 * 12);
        $token = auth('api')->attempt([
            'email' => $u->email,
            'password' => $r->password,
        ]);
        $u->token = $token;
        return Utils::apiSuccess($u, 'User registered successfully.');
    }

    public function login(Request $r)
    {

        if ($r->username == null) {
            return Utils::apiError('Username is required.');
        }
        if ($r->password == null) {
            return Utils::apiError('Password is required.');
        }
        $u = User::where('username', $r->username)
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
