<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utils extends Model
{
    use HasFactory;

    public static function tell_status($status)
    {

        // ->label([
        //     '' => 'success',
        //     'pending' => 'warning',
        //     'approved' => 'success',
        //     'rejected' => 'danger',
        //     'halted' => 'danger'
        // ])

        if (!$status)
            return '<span class="badge bg-warning">Pending</span>';
        if ($status == 1 || $status == 'pending')
            return '<span class="badge bg-warning">Pending</span>';
        if ($status == 3 || $status == 'Inspection assigned')
            return '<span class="badge bg-warning">Inspection assigned</span>';
        if ($status == 3 || $status == 'Halted')
            return '<span class="badge bg-warning">Halted</span>';
        if ($status == 4 || $status == 'Rejected')
            return '<span class="badge bg-danger">Rejected</span>';
        if ($status == 5 || $status == 'accepted')
            return '<span class="badge badge-success">Accepted</span>';

        return $status;
    }
}
