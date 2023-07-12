<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\SeedLabTestReport;
use \App\Models\TrackAndTrace;
use Illuminate\Support\Facades\Request;

class TrackAndTraceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Track and Trace';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
         $grid = new Grid(new SeedLabTestReport());

        if (Request::get('view') !== 'table') {
            $grid->setView('track_trace_form');
        }


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(SeedLabTestReport::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SeedLabTestReport());



        return $form;
    }
}

