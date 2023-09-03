
<?php
$form = \App\Models\SeedLab::find($_GET['id']);
$fieldData = [
    'Applicant' => \App\Models\User::find($form->user_id)->name,
    'Crop' => \App\Models\CropVariety::find($form->crop_variety_id)->crop_variety_name,
    'Lot number' => $form->lot_number,
    'Mother lot' => $form->mother_lot, 
    'Seed lab test number' => $form->seed_lab_test_report_number,
    'Testing methods'=> $form->testing_methods,
    'Seed sample size' => $form->seed_sample_size,
    'Date of testing' => $form->updated_at,
    'Germination test results' => $form->germination_test_results,
    'Purity test results' => $form->purity_test_results,
    'Moisture content test results' => $form->moisture_content_test_results,
    'Additional tests results' => $form->additional_tests_results,
    'Test decision' => $form->test_decision,
     
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab Test Results</title>
    <style>
        <style>
        body {
            font-family: Arial, sans-serif;
        }
        .report-card {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .header img {
            max-width: 100%;
        }
        .field-label {
            font-weight: bold;
        }
    </style>
    </style>
</head>
<body>
    <div class="report-card">
        <div class="header">
         <img src="{{ public_path('storage/assets/logo.png') }}" alt="logo">
        </div>
        <h2>Field Inspection Report Card</h2>
        @foreach ($fieldData as $fieldLabel => $fieldValue)
            <p><span class="field-label">{{ $fieldLabel }}:</span> {{ $fieldValue }}</p>
        @endforeach
    </div>
</body>
</html>
