<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CropDeclarationController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\FieldInspectionController;
use App\Http\Controllers\SeedProducerController;
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
Route::get('crops', [CropController::class, 'crops']);
Route::get('crop-varieties', [CropController::class, 'crop_varieties']);


Route::resource('seed-producers', SeedProducerController::class);
Route::resource('crop-declarations', CropDeclarationController::class);
Route::resource('field-inspections', FieldInspectionController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
Route::middleware('auth:api')->group(function () {
    // Define your protected API routes here
});
