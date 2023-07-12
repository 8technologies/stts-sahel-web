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
    $router->resource('crops', CropController::class);
    $router->resource('qds-producers', QdsProducerController::class);
    $router->resource('cooperatives', CooperativesController::class);
    $router->resource('planting-returns', PlantingReturnController::class);
    $router->resource('out-grower-contracts', OutGrowerContractController::class);
    $router->resource('load-stocks', LoadStockController::class);
    $router->resource('seed-labels', SeedLabelController::class);
    $router->resource('agro-dealers', AgroDealersController::class);
    $router->resource('field-inspections', FieldInspectionController::class);
    $router->resource('seed-lab-test-reports', SeedLabTestReportController::class);
    $router->resource('certification-forms', CertificationFormController::class);
    $router->resource('agro-dealer-agreements', AgroDealerAgreementController::class); 
    $router->resource('pre-orders', PreOrderController::class);
    $router->resource('seed-sampling-requests', SeedSamplingRequestController::class);
    $router->resource('inspection-types', InspectionTypeController::class);
    $router->resource('crop-declarations', CropDeclarationController::class);
    $router->resource('seed-classes', SeedClassController::class);
    $router->resource('track-and-traces', TrackAndTraceController::class);

});
