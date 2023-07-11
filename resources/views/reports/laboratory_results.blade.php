<!DOCTYPE html>
<html>
<head>
  <title>Laboratory Test Results</title>
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
    <div class="form-heading">Laboratory Test Results</div>

    <div class="form-section">
      <div class="form-field">
        <label for="result-number" class="form-field-label">Laboratory Test Results N°:</label>
        <input type="text" id="result-number" name="result-number" required>
      </div>
      <div class="form-field">
        <label for="batch-number" class="form-field-label">Batch Number:</label>
        <input type="text" id="batch-number" name="batch-number" required>
      </div>
      <div class="form-field">
        <label for="tests-performed" class="form-field-label">Tests Performed:</label>
        <textarea id="tests-performed" name="tests-performed" rows="3" required></textarea>
      </div>
      <div class="form-field">
        <label for="germination-results" class="form-field-label">Germination Test Results:</label>
        <textarea id="germination-results" name="germination-results" rows="3" required></textarea>
      </div>
      <div class="form-field">
        <label for="purity-results" class="form-field-label">Purity Test Results:</label>
        <textarea id="purity-results" name="purity-results" rows="3" required></textarea>
      </div>
      <div class="form-field">
        <label for="moisture-content-results" class="form-field-label">Moisture Content Test Results:</label>
        <textarea id="moisture-content-results" name="moisture-content-results" rows="3" required></textarea>
      </div>
      <div class="form-field">
        <label for="dangerous-weed-seed-results" class="form-field-label">Result of Dangerous Weed Seed:</label>
        <textarea id="dangerous-weed-seed-results" name="dangerous-weed-seed-results" rows="3" required></textarea>
      </div>
      <div class="form-field">
        <label for="red-rice-seed-results" class="form-field-label">Result of Red Rice Seed (Rice):</label>
        <textarea id="red-rice-seed-results" name="red-rice-seed-results" rows="3" required></textarea>
      </div>
      <div class="form-field">
        <label for="inert-material" class="form-field-label">Inert Material (Percentage):</label>
        <input type="text" id="inert-material" name="inert-material" required>
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
        <label for="satisfactory" class="form-field-label">Satisfactory or Rejected:</label>
        <input type="text" id="satisfactory" name="satisfactory" required>
      </div>
      <div class="form-field">
        <label for="results-date" class="form-field-label">Results Date:</label>
        <input type="text" id="results-date" name="results-date" required>
      </div>
    </div>
  </div>
</body>
</html>
