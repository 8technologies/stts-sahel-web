<!DOCTYPE html>
<html>
<head>
  <title>Laboratory Testing Report</title>
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
    <div class="form-heading">Laboratory Testing Report</div>

    <div class="form-section">
      <div class="form-field">
        <label for="report-number" class="form-field-label">Laboratory Testing Report Number:</label>
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
        <label for="test-conducted" class="form-field-label">Test Conducted:</label>
        <input type="text" id="test-conducted" name="test-conducted" required>
      </div>
      <div class="form-field">
        <label for="germination-results" class="form-field-label">Germination Test Results:</label>
        <input type="text" id="germination-results" name="germination-results" required>
      </div>
      <div class="form-field">
        <label for="purity-results" class="form-field-label">Purity Test Results:</label>
        <input type="text" id="purity-results" name="purity-results" required>
      </div>
      <div class="form-field">
        <label for="moisture-results" class="form-field-label">Moisture Content Test Results:</label>
        <input type="text" id="moisture-results" name="moisture-results" required>
      </div>
      <div class="form-field">
        <label for="harmful-weed-results" class="form-field-label">Harmful Weed Seed Result:</label>
        <input type="text" id="harmful-weed-results" name="harmful-weed-results" required>
      </div>
      <div class="form-field">
        <label for="red-rice-results" class="form-field-label">Red Rice Seed Result:</label>
        <input type="text" id="red-rice-results" name="red-rice-results" required>
      </div>
      <div class="form-field">
        <label for="satisfactory-rejected" class="form-field-label">Satisfactory or Rejected Result:</label>
        <input type="text" id="satisfactory-rejected" name="satisfactory-rejected" required>
      </div>
      <div class="form-field">
        <label for="inert-matter" class="form-field-label">Inert Matter (Percentage):</label>
        <input type="text" id="inert-matter" name="inert-matter" required>
      </div>
      <div class="form-field">
        <label for="specific-purity" class="form-field-label">Specific Purity (Percentage):</label>
        <input type="text" id="specific-purity" name="specific-purity" required>
      </div>
      <div class="form-field">
        <label for="diseases" class="form-field-label">Diseases (Percentage):</label>
        <input type="text" id="diseases" name="diseases" required>
      </div>
      <div class="form-field">
        <label for="accepted-rejected" class="form-field-label">Accepted/Rejected:</label>
        <input type="text" id="accepted-rejected" name="accepted-rejected" required>
      </div>
      <div class="form-field">
        <label for="test-date" class="form-field-label">Laboratory Test Date:</label>
        <input type="text" id="test-date" name="test-date" required>
      </div>
    </div>
  </div>
</body>
</html>
