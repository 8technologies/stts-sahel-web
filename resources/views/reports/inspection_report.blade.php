<?php
$form = \App\Models\FieldInspection::find($_GET['id']);
$fieldData = [
    'Applicant' => \App\Models\User::find($form->user_id)->name,
    'Crop Variety' => \App\Models\CropVariety::find($form->crop_variety_id)->crop_variety_name,
    'Inspection type' => \App\Models\InspectionType::find($form->inspection_type_id)->inspection_type_name,
    'Physical address' => $form->physical_address,
    'Inspector' => \App\Models\User::find($form->inspector_id)->name,
    'Field inspection form number' => $form->field_inspection_form_number,
    'Field size' => $form->field_size,
    'Type of inspection' => $form->type_of_inspection,
    'Seed generation' => $form->seed_generation,
    'Crop condition' => $form->crop_condition,
    'Field spacing' => $form->field_spacing,
    'Estimated yield' => $form->estimated_yield,
    'Signature' => $form->signature,
    'Field Decision' => $form->field_decision,
    'Remarks' => $form->remarks,
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Field Inspection Report Card</title>
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
