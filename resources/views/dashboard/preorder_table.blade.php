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

        .card {
            border-radius: 5px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
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
    </style>

    <div class="card" >
        <div class="card-header">
            <h3 class="card-title">Recent Pre Orders</h3>
            <div>
                <a href="{{ admin_url('/pre-orders') }}" class="btn-view-all">View All</a>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="min-width: 200px;">Order by</th>
                        <th style="min-width: 150px;">Crop Variety</th>
                        <th style="min-width: 150px;">Quantity</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preOrders as $preOrder)
                    @php
                    $name = App\Models\User::find($preOrder->user_id)->name;
                    $crop_variety = App\Models\CropVariety::find($preOrder->crop_variety_id)->crop_variety_name;
                    @endphp
                    <tr>
                        <td>
                            <div>
                                <a href="#" style="color: black; font-weight: 600;">{{ $name }}</a>
                               
                            </div>
                        </td>
                        <td>
                            <div>
                                <b style="color: black;">{{ Str::of($crop_variety)->limit(35) }}</b>
                                <br>
                                <span class="text-primary">{{ $preOrder->created_at }}</span>
                            </div>
                        </td>
                        <td class="text-end">
                            <span>{!! $preOrder->quantity ?? '-' !!}</span>
                        </td>
                        <td class="text-right">
                            <div>
                                <a href="{{ admin_url('/pre-orders/'.$preOrder->id) }}" title="View" class="btn-action">
                                    <i class="fa fa-eye"></i>
                                    <span>View</span>
                                </a>
                                <br>
    
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

