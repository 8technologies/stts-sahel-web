<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomRegisterController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\SeedDetailsController;
use App\Models\Gen;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//route function to go to the login page
Route::get('/', function () {
    return redirect(url('/login'));
});

Route::get('/gen', function () {
    die(Gen::find($_GET['id'])->do_get());
})->name("gen");

Route::get('/tag', function () {
    return view('reports.labels');
});


Auth::routes();
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
Route::get('/qrcode', [QrCodeController::class, 'index']);

Route::post('/trace', [SeedDetailsController::class, 'trace'])->name('seed-details');
Route::post('/track', [SeedDetailsController::class, 'track'])->name('track');

Route::get('certificate', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML(view('reports/seed_producer'));
    return $pdf->stream();
});

Route::get('label', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML(view('reports/label'));
    return $pdf->stream();
});
