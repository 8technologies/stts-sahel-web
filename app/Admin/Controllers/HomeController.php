<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            // ->row(function (Row $row) {
            //     $row->column(12, function (Column $column) {
            //         $column->append(Dashboard::cards());
            //     });
            // })
            // ->row(function (Row $row) {
            //     $row->column(4, function (Column $column) {
            //         $column->append(Dashboard::marketableSeeds());
            //     });
            //     $row->column(8, function (Column $column) {
            //         $column->append(Dashboard::crops());
            //     });
            // })

            ->row(function (Row $row) {
                $row->column(6, function (Column $column) {
                    $column->append(Dashboard::getOrders());
                });

                // $row->column(6, function (Column $column) {
                //     $column->append(Dashboard::seeds());
                // });
            });

            // ->row(function (Row $row) {
            //     $row->column(6, function (Column $column) {
            //         $column->append(Dashboard::compareCropsByPackage());
            //     });

            //     $row->column(12, function (Column $column) {
            //         $column->append(Dashboard::inspectionsChart());
            //     });
            // })
            // ->row(function (Row $row) {
            //     $row->column(12, function (Column $column) {
            //         $column->append(Dashboard:: getProcessedAndUnprocessedSeedsPerCrop());
            //     });
            // });
    }
}
