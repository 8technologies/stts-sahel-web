<?php
$form = \App\Models\SeedLab::find($_GET['id']);
$test_decision = __('admin.form.' . $form->test_decision);
$crop_id = \App\Models\CropVariety::find($form->crop_variety_id)->crop_id;
$load_stock = \App\Models\LoadStock::where('id', $form->load_stock_id)->first();
$seed_class = \App\Models\SeedClass::where('id', $load_stock->seed_class)->value('class_name');
$tests = str_replace(['[', ']', '"'], '', $form->testing_methods);
$fieldData = [
    'Demandeur' => \App\Models\User::find($form->user_id)->name,
    'Culture' => \App\Models\Crop::find($crop_id)->crop_name,
    'Variété' => \App\Models\CropVariety::find($form->crop_variety_id)->crop_variety_name,
    'Génération de semences' => $seed_class,
    'Numéro de lot' => $form->lot_number,
    'Lot mère' => $form->mother_lot, 
    'Numéro de rapport de test de laboratoire de semences' => $form->seed_lab_test_report_number,
    'Méthodes de test'=> $tests,
    'Taille de l\'échantillon de semences' => $form->seed_sample_size,
    'Date du test' => $form->updated_at,
    'Résultats du test de germination' => $form->germination_test_results,
    'Résultats du test de pureté' => $form->purity_test_results,
    'Résultats du test de teneur en humidité' => $form->moisture_content_test_results,
    'Résultats des tests supplémentaires' => $form->additional_tests_results,
    'Décision du test' => $test_decision,
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Résultats des tests de laboratoire</title>
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
</head>
<body>
    <div class="report-card">
        <div class="header">
         <img src="{{ public_path('storage/assets/logo.png') }}" alt="logo">
        </div>
        <h2>Résultats des tests de laboratoire</h2>
        @foreach ($fieldData as $fieldLabel => $fieldValue)
            <p><span class="field-label">{{ $fieldLabel }}:</span> {{ $fieldValue }}</p>
        @endforeach
        <div class="signature">
            <p>SIGNATURE DU DIRECTEUR DE DCCS</p>
           
            <img src="{{ public_path('storage/assets/signature.png') }}" alt="Signature du directeur" width="200" height="100">
        </div>
    </div>
</body>
</html>

