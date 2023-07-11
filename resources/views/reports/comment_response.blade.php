<!DOCTYPE html>
<html>
<head>
  <title>Comment Response Report</title>
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
    <div class="form-heading">Comment Response Report</div>

    <div class="form-section">
      <div class="form-field">
        <label for="response-number" class="form-field-label">Feedback Response No:</label>
        <input type="text" id="response-number" name="response-number" required>
      </div>
      <div class="form-field">
        <label for="producer-number" class="form-field-label">Seed Producer Number:</label>
        <input type="text" id="producer-number" name="producer-number" required>
      </div>
      <div class="form-field">
        <label for="approval-number" class="form-field-label">Seed Stock Approval Number:</label>
        <input type="text" id="approval-number" name="approval-number" required>
      </div>
      <div class="form-field">
        <label for="remarks" class="form-field-label">Remarks:</label>
        <textarea id="remarks" name="remarks" rows="3" required></textarea>
      </div>
      <div class="form-field">
        <label for="datetime" class="form-field-label">Date/Time:</label>
        <input type="text" id="datetime" name="datetime" required>
      </div>
    </div>
  </div>
</body>
</html>
