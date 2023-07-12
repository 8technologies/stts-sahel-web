<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('seed-producers', SeedProducerController::class);
    $router->resource('crop-declarations', CropDeclarationController::class);
    $router->resource('crops', CropController::class);
    $router->resource('inspection-types', InspectionTypeController::class);
    $router->resource('field-inspections', FieldInspectionController::class);
    $router->resource('gens', GenController::class); 
    $router->resource('load-stocks', LoadStockController::class);
    $router->resource('seed-lab-tests', SeedLabController::class);
    $router->resource('seed-sample-requests', SeedSampleController::class);
    $router->resource('seed-labels', SeedLabelController::class);

});
