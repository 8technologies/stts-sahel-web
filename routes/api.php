<?php

use App\Http\Controllers\ApiController;
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

Route::get('test', [ApiController::class, 'index']);
Route::post('register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);
Route::get('me', [ApiController::class, 'me']);
Route::get('seed-producer-forms', [ApiController::class, 'seed_producer_forms']);
Route::post('seed-producer-forms', [ApiController::class, 'seed_producer_forms_post']);
Route::get('crop-declarations', [ApiController::class, 'crop_declarations']);
Route::post('crop-declarations', [ApiController::class, 'crop_declarations_post']);
Route::get('crops', [ApiController::class, 'crops']);
Route::get('crop-varieties', [ApiController::class, 'crop_varieties']);
Route::get('field-inspections', [ApiController::class, 'field_inspections']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
