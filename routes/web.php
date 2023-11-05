<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomRegisterController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\SeedDetailsController;
use App\Admin\Controllers\FeedBackController;
use App\Admin\Controllers\SeedLabelController;
use App\Admin\Controllers\OrderController;
use App\Http\Controllers\ContractController;
use App\Models\Gen;
use Illuminate\Support\Facades\App;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
    return redirect(admin_url('/auth/login'));
});
Route::get('/map', function () {
    return view('admin.show_map');
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
    $pdf->loadHTML(view('reports/labels'));
    return $pdf->stream();
});

Route::get('certificate', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML(view('reports/seed_producer'));
    return $pdf->stream();
});

Route::get('research', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML(view('reports/research_report'));
    return $pdf->stream();
});

Route::get('lab_results', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML(view('reports/laboratory_results'));
    return $pdf->stream();
});

Route::get('agro_certificate', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML(view('reports/agro_dealer_certificate'));
    return $pdf->stream();
});

Route::get('cooperative', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML(view('reports/cooperative'));
    return $pdf->stream();
});

Route::get('individual', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML(view('reports/individual_producer'));
    return $pdf->stream();
});

Route::get('inspection', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML(view('reports/inspection_report'));
    return $pdf->stream();
});

Route::get('/admin/mobile', function () {
    $file = public_path('storage/assets/mobile.zip');
    $headers = [
        'Content-Type' => 'application/vnd.android.package-archive',
    ];

    return response()->download($file, 'mobile.apk', $headers);
});

Route::put('/admin/seed-labels/{id}/confirm',  [SeedLabelController::class, 'confirm'])->name('print.confirm');
Route::put('/admin/orders/{id}/confirm',  [OrderController::class, 'confirm'])->name('delivery.confirm');


Route::get('/feedback/{lotId}', [FeedBackController::class, 'feedbackDetails']);
//Route::get('/contract/{id}', [ContractController::show])->name('contract.show');
