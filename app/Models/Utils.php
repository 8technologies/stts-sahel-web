<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utils extends Model
{
    use HasFactory;

    public static function tell_status($status)
    {
        if (!$status)
            return '<span class="badge bg-warning">Pending</span>';
        if ($status == 1)
            return '<span class="badge bg-warning">Pending</span>';
        if ($status == 2)
            return '<span class="badge bg-warning">Inspection assigned</span>';
        if ($status == 3)
            return '<span class="badge bg-warning">Halted</span>';
        if ($status == 4)
            return '<span class="badge bg-danger">Rejected</span>';
        if ($status == 5)
            return '<span class="badge bg-success">Accepted</span>';
       
        return $status;
    }
}
