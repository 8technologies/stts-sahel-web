<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Utils extends Model
{
    use HasFactory;

    public static function apiSuccess($data = null, $message = 'Success')
    {
        header('Content-Type: application/json');

        die(json_encode([
            'code' => 1,
            'message' => $message,
            'data' => $data
        ]));
    }
    public static function apiError($message = 'Error', $data = null)
    {
        header('Content-Type: application/json');
        die(json_encode([
            'code' => 0,
            'message' => $message,
            'data' => $data
        ]));
    }



    public static function tell_status($status)
    {

        if (!$status)
            return '<span class="label label-warning">Pending</span>';
        if ($status == 'pending')
            return '<span class="label label-warning">Pending</span>';
        if ($status == 'inspection assigned')
            return '<span class="label label-warning">Inspection assigned</span>';
        if ($status == 'halted')
            return '<span class="label label-warning">Halted</span>';
        if ($status == 'rejected')
            return '<span class="label label-danger">Rejected</span>';
        if ($status == 'accepted')
            return '<span class="label label-success">Accepted</span>';
        if ($status == 'lab test assigned')
            return '<span class="label label-success">Lab Test Assigned</span>';
        if ($status == 'printed')
            return '<span class="label label-success">Printed</span>';
        if ($status == 'marketable')
            return '<span class="label label-success">Marketable</span>';
        if ($status == 'not marketable')
            return '<span class="label label-danger">Not Marketable</span>';



        return $status;
    }

    public static function start_session()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function month($max_date)
    {
        $label = Carbon::parse($max_date);
        if ($max_date == null) {
            return $max_date;
        }
        return $label->format('M - Y');
    }
}
