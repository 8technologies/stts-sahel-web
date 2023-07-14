<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Admin;
use Illuminate\Support\Arr;

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
}