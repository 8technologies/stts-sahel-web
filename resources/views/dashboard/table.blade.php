<?php
use App\Models\Utils;
?>

    <style>
        .ext-icon {
            color: rgba(0, 0, 0, 0.5);
            margin-left: 10px;
        }

        .installed {
            color: #00a65a;
            margin-right: 10px;
        }
        

     

        .btn-view-all {
            font-size: 14px;
            padding: 6px 12px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            font-weight: bold;
        }

        .table-row-dashed {
            border-bottom: 1px dashed #ddd;
        }

        .table-row-gray-300 {
            background-color: #f8f9fa;
        }

        .text-right {
            text-align: right;
        }

        .btn-action {
            font-size: 16px;
            padding: 0;
            margin: 0;
            background-color: transparent;
            border: none;
            color: #000;
        }

        .btn-action i {
            margin-right: 5px;
        }
        @media (max-width: 767px) {
        .table th,
        .table td {
            padding: 6px;
            font-size: 12px;
        }

        .table th {
            min-width: auto;
        }

        .table th:nth-child(1),
        .table td:nth-child(1),
        .table th:nth-child(2),
        .table td:nth-child(2),
        .table th:nth-child(3),
        .table td:nth-child(3) {
            display: none;
        }

        .table td {
            text-align: left;
            white-space: normal; /* Allow text to wrap */
            overflow-wrap: break-word; /* Handle word wrapping */
        }

        .table-row-gray-300 {
            background-color: #fff; /* Reset background color for rows */
        }
    }
    </style>

    <div class="card" >
    <div class="card-header" style="position: relative;">
    <h3 class="card-title">Recent Crop Declarations</h3>
    <div style="position: absolute; top: 0; right: 0;">
        <a href="{{ admin_url('/crop-declarations') }}" class="btn-view-all">View All</a>
    </div>
</div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="min-width: 200px;">Applicant</th>
                        <th style="min-width: 150px;">Crop Variety</th>
                        <th style="min-width: 150px;">Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($crops as $crop)
                    @php
                    $name = App\Models\User::find($crop->user_id)->name;
                    $crop_variety = App\Models\CropVariety::find($crop->crop_variety_id)->crop_variety_name;
                    @endphp
                    <tr>
                    <td>
    <div class="table-cell-content">
        <a href="#" style="color: black; font-weight: 600;">{{ $name }}</a>
        <br>
        <span class="text-muted">{{ $crop->field_name }}</span>
        <br>
        <span class="text-muted">
            <b class="small text-dark">Garden Size:</b>
            {{ Str::of($crop->garden_size)->limit(10) }}
        </span>
    </div>
</td>
<td>
    <div class="table-cell-content">
        <b style="color: black;">{{ Str::of($crop_variety)->limit(35) }}</b>
        <br>
        <span class="text-primary">{{ $crop->updated_at }}</span>
    </div>
</td>
<td class="text-end">
    <span>{!! Utils::tell_status($crop->status) ?? '-' !!}</span>
</td>
<td class="text-right">
    <div>
        <a href="{{ admin_url('/crop-declarations/'.$crop->id) }}" title="View" class="btn-action">
            <i class="fa fa-eye"></i>
            <span>View</span>
        </a>
        <br>
        <a href="{{ admin_url('/crop-declarations/'.$crop->id.'/edit') }}" title="Edit" class="btn-action">
            <i class="fa fa-edit"></i>
            <span>Edit</span>
        </a>
    </div>
</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

