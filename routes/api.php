<?php

use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Apis\CropDeclarationController;
use App\Http\Controllers\Apis\CropController;
use App\Http\Controllers\Apis\FieldInspectionController;
use App\Http\Controllers\Apis\SeedProducerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('test', [AuthController::class, 'index']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('me', [AuthController::class, 'me']);
Route::get('seed-producer-forms', [SeedProducerController::class, 'seed_producer_forms']);
Route::post('seed-producer-forms', [SeedProducerController::class, 'seed_producer_forms_post']);
Route::get('crop-declarations', [CropDeclarationController::class, 'crop_declarations']);
Route::post('crop-declarations', [CropDeclarationController::class, 'crop_declarations_post']);
Route::get('crops', [CropController::class, 'crops']);
Route::get('crop-varieties', [CropController::class, 'crop_varieties']);
Route::get('field-inspections', [FieldInspectionController::class, 'field_inspections']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
