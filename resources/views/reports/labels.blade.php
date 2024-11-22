<?php
$link = public_path('css/bootstrap-print.css');
$package = App\Models\SeedLabelPackage::find($_GET['id']);
$label =App\Models\LabelPackage::find( $package->package_id);
$seed_label = App\Models\SeedLabel::find($package->seed_label_id);
$seed_lab = App\Models\SeedLab::find($seed_label->seed_lab_id);
$load_stock = App\Models\LoadStock::where('id', $seed_lab->load_stock_id)->where('user_id', $seed_lab->user_id )->first();
$seed_class = App\Models\SeedClass::where('id', $load_stock->seed_class)->value('class_name');

$crop_declaration = $load_stock->crop_declaration_id;
//get crop variety from crop_declaration id
//$crop_variety_id = App\Models\CropDeclaration::where('id', $crop_declaration)->value('crop_variety_id');
//get crop variety name from crop_variety id
$crop_variety= App\Models\CropVariety::find($load_stock->crop_variety_id);
//get crop name from crop variety
$crop_name = App\Models\Crop::where('id', $crop_variety->crop_id)->value('crop_name');
//get current date
$today = date("F j, Y");

?>

<!DOCTYPE html>
<html>
<head>
  <title>Issuance of Seed Tags</title>
  
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .form-container {
      margin: 20px;
    }
    .form-section {
      margin-bottom: 20px;
    }
    .form-heading {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .form-field-label {
      font-weight: bold;
      margin-bottom: 5px;
    }
    .form-field {
      margin-bottom: 10px;
    }
    .form-section {
      display: table;
      width: 100%;
    }
    .form-field-column {
      display: table-cell;
      vertical-align: top;
      width: 50%;
    }
    .form-field-column:not(:last-child) {
      padding-right: 10px;
    }
    .card {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
    /* Add additional styles as needed */
  </style>
</head>
<body>
  <div class="form-container">

    <div class="card">
      <div class="card-header">
      </div>
      <div class="form-section">
      <div class="form-field-column">
    <div class="card-body">
        <!-- Place the QR code here -->
        <img src="data:image/png;base64,{{ base64_encode(QrCode::size(200)->generate($seed_lab->lot_number)) }}" alt="QR Code" />
    </div>
</div>

        <div class="form-field-column">
        <div class="form-field">
          <label for="analysis-number" class="form-field-label">Numéro de lot : {{$seed_lab->lot_number}}</label>
        </div>
        <div class="form-field">
          <label for="seed-company" class="form-field-label">Culture : {{$crop_name}}</label>
        </div>
        <div class="form-field">
          <label for="registration-number" class="form-field-label">Variété : {{$crop_variety->crop_variety_name}}</label>
        </div>
        <div class="form-field">
          <label for="seed-category" class="form-field-label">Génération de semences : {{ $seed_class}}</label>
        </div>
        <div class="form-field">
          <label for="seed-category" class="form-field-label">Quantité : {{ $label->quantity . ' kgs' }}</label>
  </div>
        
      <div>
        
      <img src="{{ public_path('storage/assets/logo.png') }}" alt="logo">
      </div>
         
        </div>
      </div>
    </div>
  </div>
 
</body>
</html>
