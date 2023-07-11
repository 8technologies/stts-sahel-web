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
});
