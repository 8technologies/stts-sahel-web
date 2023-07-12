<?php
$link = public_path('css/bootstrap-print.css');
$form = App\Models\SeedProducer::find($_GET['id']);
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
    /* Add additional styles as needed */
  </style>
</head>
<body>
  <div class="form-container">
    <div class="form-heading">Issuance of Seed Tags</div>
    <div class="card">
      <div class="card-header"></div>
      <div class="form-section">
      <div class="form-field-column">
    <div class="card-body">
        <!-- Place the QR code here -->
        <img src="data:image/png;base64,{{ base64_encode(QrCode::size(200)->generate('66666')) }}" alt="QR Code" />
    </div>
</div>

        <div class="form-field-column">
          <div class="form-field">
            <label for="analysis-number" class="form-field-label">Analysis No.:</label>
            <p></p>
          </div>
          <div class="form-field">
            <label for="seed-company" class="form-field-label">Seed Company:</label>
            <p></p>
          </div>
          <div class="form-field">
            <label for="registration-number" class="form-field-label">Seed Company Registration Number:</label>
            <p></p>
          </div>
          <div class="form-field">
            <label for="seed-category" class="form-field-label">Seed Category (Color):</label>
            <p></p>
          </div>
          <div class="form-field">
            <label for="culture" class="form-field-label">Culture:</label>
            <p></p>
          </div>
          <div class="form-field">
            <label for="variety" class="form-field-label">Variety:</label>
            <p></p>
          </div>
        </div>
      </div>
    </div>
  </div>
 
</body>
</html>
