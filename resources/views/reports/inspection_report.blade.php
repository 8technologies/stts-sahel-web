<?php
// Retrieve the necessary data
$form = \App\Models\FieldInspection::find($_GET['id']);
$imagePath = public_path('storage/' . $form->signature);

if (file_exists($imagePath) && is_readable($imagePath) && !is_dir($imagePath)) {
    $image = $imagePath;
} else {
    // Set to null or a default image path
    $image = null; // or public_path('path/to/default/image.jpg');
}

$inspector = \App\Models\User::find($form->inspector_id)->name;
$status = __('admin.form.' . $form->status);
$fieldData = [
    'Demandeur' => \App\Models\User::find($form->user_id)->name,
    'Variété de Culture' => \App\Models\CropVariety::find($form->crop_variety_id)->crop_variety_name,
    'Type d\'inspection' => \App\Models\InspectionType::find($form->inspection_type_id)->inspection_type_name,
    'Adresse physique' => $form->physical_address,
    'Inspecteur' => \App\Models\User::find($form->inspector_id)->name,
    'Numéro de formulaire d\'inspection sur le terrain' => $form->field_inspection_form_number,
    'Taille du champ' => $form->field_size . ' ha',
    'Génération de semences' => \App\Models\SeedClass::find($form->seed_generation)->class_name,
    'État de la culture' => $form->crop_condition,
    'Densité de plantes' => $form->plant_density,
    'Rendement estimé' => $form->estimated_yield . ' kgs',
    'Décision sur le terrain' => $status,
    'Remarques' => $form->remarks,
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rapport de l'inspection sur le terrain</title>
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
        /* Use flexbox to align signatures side by side */
        .signatures-container {
            display: flex;
        }

        /* Styling for each signature block */
        .signature {
            margin: 2px; /* Adjust margins as needed */
        }
    </style>
</head>
<body>
    <div class="report-card">
        <div class="header">
            <img src="{{ public_path('/storage/assets/Republique Du Mali Logo.png') }}" alt="logo">
        </div>
        <h2>Rapport de l'inspection sur le terrain</h2>
        @foreach ($fieldData as $fieldLabel => $fieldValue)
            <p><span class="field-label">{{ $fieldLabel }} :</span> {{ $fieldValue }}</p>
        @endforeach
        <div class="signatures-container">
            <div class="signature">
                <p>SIGNATURE DU DIRECTEUR DE DCCS</p>
               
                <img src="{{ public_path('storage/assets/signature.png') }}" alt="Signature du directeur" width="200" height="100">
            </div>
            <div class="signature">
                <p>SIGNATURE DE L'INSPECTEUR</p>
                <p>{{ $inspector }}</p>
                @if ($image)
                    <img src="{{ $image }}" alt="Signature de l'inspecteur" width="200" height="100">
                @else
                    <img src="{{ public_path('storage/assets/No_signature.png') }}" alt="Signature de l'inspecteur" width="50" height="50">
                @endif

            </div>
        </div>
    </div>
</body>
</html>
