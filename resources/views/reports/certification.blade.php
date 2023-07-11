<!DOCTYPE html>
<html>
<head>
  <title>Certification</title>
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
  </style>
</head>
<body>
  <div class="form-container">
    <div class="form-heading">CERTIFICATE</div>

    <div class="form-section">
      <p>The referenced seed lot has been produced in accordance with the Technical Regulatory provisions for seed production, quality control, and seed certification, and it is accepted as:</p>

      <div class="form-field">
        <label for="seed-label" class="form-field-label">Seed (1) Label:</label>
        <input type="text" id="seed-label" name="seed-label" required>
      </div>
      <div class="form-field">
        <label for="reference-number" class="form-field-label">Reference Number:</label>
        <input type="text" id="reference-number" name="reference-number" required>
      </div>
      <div class="form-field">
        <label for="species" class="form-field-label">Species:</label>
        <input type="text" id="species" name="species" required>
      </div>
      <div class="form-field">
        <label for="variety" class="form-field-label">Variety:</label>
        <input type="text" id="variety" name="variety" required>
      </div>
      <div class="form-field">
        <label for="declared-weight" class="form-field-label">Declared Weight of the Lot:</label>
        <input type="text" id="declared-weight" name="declared-weight" required>
      </div>
      <div class="form-field">
        <label for="num-packets" class="form-field-label">Number of Packets:</label>
        <input type="text" id="num-packets" name="num-packets" required>
      </div>
      <div class="form-field">
        <label for="weight-per-packet" class="form-field-label">Weight per Packet:</label>
        <input type="text" id="weight-per-packet" name="weight-per-packet" required>
      </div>
      <div class="form-field">
        <label for="label-numbers" class="form-field-label">Assigned Label Numbers:</label>
        <input type="text" id="label-numbers" name="label-numbers" required>
      </div>
      <div class="form-field">
        <label for="location" class="form-field-label">Done at [Location], on [Date]:</label>
        <input type="text" id="location" name="location" required>
        <input type="text" id="date" name="date" required>
      </div>

      <div class="form-field">
        <label for="head-signature" class="form-field-label">Head of Seed Quality Control and Certification Service:</label>
        <input type="text" id="head-signature" name="head-signature" required>
      </div>
    </div>
  </div>
</body>
</html>
