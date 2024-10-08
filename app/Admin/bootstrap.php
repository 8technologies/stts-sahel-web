<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

Encore\Admin\Form::forget(['map', 'editor']);

Admin::navbar(function (\Encore\Admin\Widgets\Navbar $navbar) {
    $notifications = [];
    $user =  Auth::user();
    if ($user != null) {
        $notifications = Notification::get_notifications($user);
    }

    $navbar->right(view('notification_bell', ['notifications' => $notifications]));
      //add language
      $navbar->right(view('language'));
    
});

