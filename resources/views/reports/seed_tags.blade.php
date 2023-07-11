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
  </style>
</head>
<body>
  <div class="form-container">
    <div class="form-heading">Issuance of Seed Tags</div>

    <div class="form-section">
      <div class="form-field">
        <label for="analysis-number" class="form-field-label">Analysis No.:</label>
        <input type="text" id="analysis-number" name="analysis-number" required>
      </div>
      <div class="form-field">
        <label for="seed-company" class="form-field-label">Seed Company:</label>
        <input type="text" id="seed-company" name="seed-company" required>
      </div>
      <div class="form-field">
        <label for="registration-number" class="form-field-label">Seed Company Registration Number:</label>
        <input type="text" id="registration-number" name="registration-number" required>
      </div>
      <div class="form-field">
        <label for="seed-category" class="form-field-label">Seed Category (Color):</label>
        <input type="text" id="seed-category" name="seed-category" required>
      </div>
      <div class="form-field">
        <label for="culture" class="form-field-label">Culture:</label>
        <input type="text" id="culture" name="culture" required>
      </div>
      <div class="form-field">
        <label for="variety" class="form-field-label">Variety:</label>
        <input type="text" id="variety" name="variety" required>
      </div>
      <div class="form-field">
        <label for="batch-number" class="form-field-label">Batch Number:</label>
        <input type="text" id="batch-number" name="batch-number" required>
      </div>
      <div class="form-field">
        <label for="weight" class="form-field-label">Weight:</label>
        <input type="text" id="weight" name="weight" required>
      </div>
      <div class="form-field">
        <label for="number-of-labels" class="form-field-label">Number of Labels:</label>
        <input type="text" id="number-of-labels" name="number-of-labels" required>
      </div>
      <div class="form-field">
        <label for="varietal-purity" class="form-field-label">Varietal Purity (Percentage):</label>
        <input type="text" id="varietal-purity" name="varietal-purity" required>
      </div>
      <div class="form-field">
        <label for="germination" class="form-field-label">Germination (Percentage):</label>
        <input type="text" id="germination" name="germination" required>
      </div>
      <div class="form-field">
        <label for="diseases" class="form-field-label">Diseases (Percentage):</label>
        <input type="text" id="diseases" name="diseases" required>
      </div>
      <div class="form-field">
        <label for="label-packaging" class="form-field-label">Label Packaging:</label>
        <input type="text" id="label-packaging" name="label-packaging" required>
      </div>
      <div class="form-field">
        <label for="service-responsable" class="form-field-label">Service Responsable:</label>
        <input type="text" id="service-responsable" name="service-responsable" required>
      </div>
      <div class="form-field">
        <label for="signature" class="form-field-label">Signature:</label>
        <input type="text" id="signature" name="signature" required>
      </div>
      <div class="form-field">
        <label for="print-date" class="form-field-label">Print Date:</label>
        <input type="text" id="print-date" name="print-date" required>
      </div>
      <div class="form-field">
        <label for="deadline" class="form-field-label">Deadline:</label>
        <input type="text" id="deadline" name="deadline" required>
      </div>
    </div>
  </div>
</body>
</html>
