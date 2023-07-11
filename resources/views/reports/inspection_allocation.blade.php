<!DOCTYPE html>
<html>
<head>
  <title>Inspection Allocation Notice</title>
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
    <div class="form-heading">Inspection Allocation Notice</div>

    <div class="form-section">
      <div class="form-field">
        <label for="allocation-number" class="form-field-label">Inspection Allocation Number:</label>
        <input type="text" id="allocation-number" name="allocation-number" required>
      </div>
      <div class="form-field">
        <label for="inspector-name" class="form-field-label">Inspector's Name:</label>
        <input type="text" id="inspector-name" name="inspector-name" required>
      </div>
      <div class="form-field">
        <label for="company-name" class="form-field-label">Company Name:</label>
        <input type="text" id="company-name" name="company-name" required>
      </div>
      <div class="form-field">
        <label for="registration-number" class="form-field-label">Company Registration Number:</label>
        <input type="text" id="registration-number" name="registration-number" required>
      </div>
      <div class="form-field">
        <label for="field-name" class="form-field-label">Field Name:</label>
        <input type="text" id="field-name" name="field-name" required>
      </div>
      <div class="form-field">
        <label for="inspection-date" class="form-field-label">Inspection Date:</label>
        <input type="text" id="inspection-date" name="inspection-date" required>
      </div>
      <div class="form-field">
        <label for="remarks" class="form-field-label">Remarks:</label>
        <textarea id="remarks" name="remarks" rows="3" required></textarea>
      </div>
      <div class="form-field">
        <label for="responsible-officer" class="form-field-label">Responsible Officer:</label>
        <input type="text" id="responsible-officer" name="responsible-officer" required>
      </div>
      <div class="form-field">
        <label for="signature" class="form-field-label">Signature:</label>
        <input type="text" id="signature" name="signature" required>
      </div>
    </div>
  </div>
</body>
</html>
