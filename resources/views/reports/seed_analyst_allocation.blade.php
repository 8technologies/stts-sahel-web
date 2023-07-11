<!DOCTYPE html>
<html>
<head>
  <title>Seed Analyst Allocation Notification</title>
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
    <div class="form-heading">Seed Analyst Allocation Notification</div>

    <div class="form-section">
      <div class="form-field">
        <label for="allocation-number" class="form-field-label">Seed Analyst Allocation Number:</label>
        <input type="text" id="allocation-number" name="allocation-number" required>
      </div>
      <div class="form-field">
        <label for="analyst-name" class="form-field-label">Seed Analyst Name:</label>
        <input type="text" id="analyst-name" name="analyst-name" required>
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
        <label for="physical-address" class="form-field-label">Physical Address:</label>
        <input type="text" id="physical-address" name="physical-address" required>
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
        <label for="collection-date" class="form-field-label">Sample Collection Date:</label>
        <input type="text" id="collection-date" name="collection-date" required>
      </div>
      <div class="form-field">
        <label for="remarks" class="form-field-label">Remarks:</label>
        <textarea id="remarks" name="remarks" rows="3" required></textarea>
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
