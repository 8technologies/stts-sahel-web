<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Admin;
use Illuminate\Support\Arr;
use App\Models\CropDeclaration;

class Dashboard
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function cards(){
        return view('dashboard.cards');
    }

    public static function graph1(){
        return view('dashboard.graph1');
    }

    public static function graph2(){
        return view('dashboard.graph2');
    }

    public static function crops()
    {
        $crops = CropDeclaration::orderBy('updated_at', 'Desc')->limit(6)->get();

        return view('dashboard.table', [ 'crops' => $crops]);
    }

    //function to get the total number of marketable seeds for each month
    
}