<!DOCTYPE html>
<html>
<head>
  <title>Post-Labeling Control Report</title>
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
    <div class="form-heading">POST-LABELING CONTROL REPORT</div>

    <div class="form-section">
      <div class="form-field">
        <label for="reconciliation-number" class="form-field-label">Label Reconciliation Number:</label>
        <input type="text" id="reconciliation-number" name="reconciliation-number" required>
      </div>
      <div class="form-field">
        <label for="applicant-name" class="form-field-label">Applicant's Name:</label>
        <input type="text" id="applicant-name" name="applicant-name" required>
      </div>
      <div class="form-field">
        <label for="registration-number" class="form-field-label">Applicant Registration Number:</label>
        <input type="text" id="registration-number" name="registration-number" required>
      </div>
      <div class="form-field">
        <label for="seed-generation" class="form-field-label">Seed Generation:</label>
        <input type="text" id="seed-generation" name="seed-generation" required>
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
        <label for="label-packaging" class="form-field-label">Label Packaging:</label>
        <input type="text" id="label-packaging" name="label-packaging" required>
      </div>
      <div class="form-field">
        <label for="printing-date" class="form-field-label">Printing Date:</label>
        <input type="text" id="printing-date" name="printing-date" required>
      </div>
      <div class="form-field">
        <label for="expiration-date" class="form-field-label">Expiration Date:</label>
        <input type="text" id="expiration-date" name="expiration-date" required>
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
