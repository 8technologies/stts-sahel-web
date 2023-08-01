<style>
    .card {
        border: 1px solid green;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        /* padding around */
        padding: 20px;
    }
</style>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">Seed Producers</h3>
            </div>
            <div class="card-body">
                <h4 class="mb-2">{{ $data['total_seedproducers'] }}</h4>
                <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="glyphicon glyphicon-hourglass me-1 align-middle"></i>{{ $data['pending_seedproducers'] }}</span><a href="{{ admin_url('/seed-producers')}}">pending applications</a></p>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card panel-success">
            <div class="card-header">
                <h3 class="card-title">Seed Sample Requests</h3>
            </div>
            <div class="card-body">
                <h4 class="mb-2"> {{ $data['total_samples'] }}</h4>
                <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="glyphicon glyphicon-hourglass me-1 align-middle"></i>{{ $data['pending_samples'] }}</span><a href="{{ admin_url('/seed-labs')}}">pending applications</a></p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card panel-success">
            <div class="card-header">
                <h3 class="card-title">Field Inspections</h3>
            </div>
            <div class="card-body">
                <h4 class="mb-2"> {{ $data['total_inspections'] }}</h4>
                <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="glyphicon glyphicon-hourglass me-1 align-middle"></i>{{ $data['pending_inspections'] }}</span><a href="{{ admin_url('/agro-dealers')}}">pending applications</a></p>
            </div>
        </div>
    </div>

</div>