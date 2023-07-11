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

    public function seed_producer_forms()
    {
        $u = auth('api')->user();
        return Utils::apiSuccess(SeedProducer::where([])->get());
    }
    public function crops()
    {
        return Utils::apiSuccess(Crop::where([])->get());
    }
    public function crop_varieties()
    {
        return Utils::apiSuccess(CropVariety::where([])->get());
    }
    public function crop_declarations()
    {
        $u = auth('api')->user();
        return Utils::apiSuccess(CropDeclaration::where('applicant_id', $u->id)->get());
    }
    public function field_inspections()
    {
        $u = auth('api')->user();
        return Utils::apiSuccess(FieldInspection::where('applicant_id', $u->id)->get());
    }

    public function seed_producer_forms_post(Request $r)
    {
        $u = auth('api')->user();
        $sp = SeedProducer::where('user_id', $u->id)->first();
        if ($sp == null) {
            $sp = new SeedProducer();
            $sp->user_id = $u->id;
        }
        $sp->name_of_applicant = $r->name_of_applicant;
        $sp->producer_category = $r->producer_category;
        $sp->applicant_phone_number = $r->applicant_phone_number;
        $sp->applicant_email = $r->applicant_email;
        $sp->premises_location = $r->premises_location;
        $sp->proposed_farm_location = $r->proposed_farm_location;
        // $sp->premises_size = $r->premises_size;
        $sp->years_of_experience = $r->years_of_experience;
        $sp->gardening_history_description = $r->gardening_history_description;
        $sp->storage_facilities_description = $r->storage_facilities_description;
        $sp->have_adequate_isolation = $r->have_adequate_isolation;
        $sp->labor_details = $r->labor_details;
        $sp->receipt = $r->receipt; //file
        $sp->status_comment = $r->status_comment;
        try {
            $sp->save();
        } catch (\Throwable $th) {
            return Utils::apiError('Error saving form. ' . $th->getMessage());
        }
        return Utils::apiSuccess($sp, 'Seed Producer form submitted successfully.');
    }

    public function crop_declarations_post(Request $r)
    {
        $u = auth('api')->user();
        $sp = SeedProducer::where('user_id', $u->id)->first();
        if ($sp == null) {
            return Utils::apiError('You need a valid Seed Producer Certiificate t apply for crop declaration.');
        }
        if ($sp->status != 'accepted') {
            return Utils::apiError('Your Seed Producer Application is not accepted yet.');
        }
        $cv = CropVariety::find($r->crop_variety_id);
        if ($cv == null) {
            return Utils::apiError('Invalid crop variety.');
        }

        $cd = new CropDeclaration();
        $cd->applicant_id = $u->id;
        $cd->seed_producer_id = $sp->id;
        $cd->phone_number = $r->phone_number;
        $cd->applicant_registration_number = $r->applicant_registration_number;
        $cd->garden_size = $r->garden_size;
        $cd->gps_coordinates_1 = $r->gps_coordinates_1;
        $cd->gps_coordinates_2 = $r->gps_coordinates_2;
        $cd->gps_coordinates_3 = $r->gps_coordinates_3;
        $cd->gps_coordinates_4 = $r->gps_coordinates_4;
        $cd->field_name = $r->field_name;
        $cd->district_region = $r->district_region;
        $cd->circle = $r->circle;
        $cd->township = $r->township;
        $cd->village = $r->village;
        $cd->planting_date = $r->planting_date;
        $cd->quantity_of_seed_planted = $r->quantity_of_seed_planted;
        $cd->expected_yield = $r->expected_yield;
        $cd->seed_supplier_name = $r->seed_supplier_name;
        $cd->seed_supplier_registration_number = $r->seed_supplier_registration_number;
        $cd->source_lot_number = $r->source_lot_number;
        $cd->origin_of_variety = $r->origin_of_variety;
        $cd->garden_location_latitude = $r->garden_location_latitude;
        $cd->garden_location_longitude = $r->garden_location_longitude;
        $cd->crop_variety_id = $r->crop_variety_id;

        try {
            $cd->save();
        } catch (\Throwable $th) {
            return Utils::apiError('Error saving form. ' . $th->getMessage());
        }
        return Utils::apiSuccess($sp, 'Crop Declaration form submitted successfully.');
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
            $role->role_id = 5;
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

        if ($r->email == null) {
            return Utils::apiError('Email is required.');
        }
        if ($r->password == null) {
            return Utils::apiError('Password is required.');
        }
        $u = User::where('email', $r->email)
            ->orWhere('username', $r->email)
            ->first();
        if ($u == null) {
            return Utils::apiError('User account not found.');
        }


        JWTAuth::factory()->setTTL(60 * 24 * 30 * 12);
        $token = auth('api')->attempt([
            'email' => $u->email,
            'password' => $r->password,
        ]);

        if ($token == null) {
            return Utils::apiError('Invalid credentials.');
        }
        $u->token = $token;
        return Utils::apiSuccess($u, 'User registered successfully.');
    }
}
