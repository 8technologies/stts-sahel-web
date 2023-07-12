<?php

/**
 * Open-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * OpenAdmin\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * OpenAdmin\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

OpenAdmin\Admin\Form::forget(['editor']);
use App\Models\Notification;


Admin::navbar(function (\OpenAdmin\Admin\Widgets\Navbar $navbar) {
   
    $notifications = [];
    $user =  Auth::user();
    if ($user != null) {
        $notifications = Notification::get_notifications($user);
    }
     //dd(json_encode($notifications));
    $navbar->right(view('notification_bell', ['notifications' => $notifications]));
});