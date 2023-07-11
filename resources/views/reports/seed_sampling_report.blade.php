<!DOCTYPE html>
<html>
<head>
  <title>Seed Sampling Report</title>
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
    <div class="form-heading">Seed Sampling Report</div>

    <div class="form-section">
      <div class="form-field">
        <label for="report-number" class="form-field-label">Seed Sample Report Number:</label>
        <input type="text" id="report-number" name="report-number" required>
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
        <label for="seed-category" class="form-field-label">Seed Category:</label>
        <input type="text" id="seed-category" name="seed-category" required>
      </div>
      <div class="form-field">
        <label for="crop" class="form-field-label">Crop:</label>
        <input type="text" id="crop" name="crop" required>
      </div>
      <div class="form-field">
        <label for="variety" class="form-field-label">Variety:</label>
        <input type="text" id="variety" name="variety" required>
      </div>
      <div class="form-field">
        <label for="lot-number" class="form-field-label">Lot Number:</label>
        <input type="text" id="lot-number" name="lot-number" required>
      </div>
      <div class="form-field">
        <label for="sample-size" class="form-field-label">Sample Size:</label>
        <input type="text" id="sample-size" name="sample-size" required>
      </div>
      <div class="form-field">
        <label for="representative-quantity" class="form-field-label">Representative Quantity:</label>
        <input type="text" id="representative-quantity" name="representative-quantity" required>
      </div>
      <div class="form-field">
        <label for="analyst-info" class="form-field-label">Analyst Information:</label>
        <textarea id="analyst-info" name="analyst-info" rows="3" required></textarea>
      </div>
      <div class="form-field">
        <label for="inspector-decision" class="form-field-label">Inspector's Decision (Approved/Rejected):</label>
        <input type="text" id="inspector-decision" name="inspector-decision" required>
      </div>
      <div class="form-field">
        <label for="responsible-department" class="form-field-label">Responsible Department:</label>
        <input type="text" id="responsible-department" name="responsible-department" required>
      </div>
      <div class="form-field">
        <label for="signature" class="form-field-label">Signature:</label>
        <input type="text" id="signature" name="signature" required>
      </div>
    </div>
  </div>
</body>
</html>
