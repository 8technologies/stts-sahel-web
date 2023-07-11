<!DOCTYPE html>
<html>
<head>
  <title>Approval Stock Notification</title>
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
    <div class="form-heading">Approval Stock Notification</div>

    <div class="form-section">
      <div class="form-field">
        <label for="approval-number" class="form-field-label">Stock Approval Number:</label>
        <input type="text" id="approval-number" name="approval-number" required>
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
        <label for="lot-number" class="form-field-label">Lot Number:</label>
        <input type="text" id="lot-number" name="lot-number" required>
      </div>
      <div class="form-field">
        <label for="quantity" class="form-field-label">Quantity:</label>
        <input type="text" id="quantity" name="quantity" required>
      </div>
      <div class="form-field">
        <label for="stock-status" class="form-field-label">Stock Status (Approved/Rejected):</label>
        <input type="text" id="stock-status" name="stock-status" required>
      </div>
      <div class="form-field">
        <label for="approval-date" class="form-field-label">Approval Date:</label>
        <input type="text" id="approval-date" name="approval-date" required>
      </div>
    </div>
  </div>
</body>
</html>
