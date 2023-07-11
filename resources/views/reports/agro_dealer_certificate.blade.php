<!DOCTYPE html>
<html>
<head>
  <title>Registration Certificate</title>
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
    <div class="form-heading">Registration Certificate</div>

    <div class="form-section">
      <div class="form-field">
        <label for="dealer-number" class="form-field-label">Agricultural Dealer Number:</label>
        <input type="text" id="dealer-number" name="dealer-number" required>
      </div>
      <div class="form-field">
        <label for="last-name" class="form-field-label">Last Name:</label>
        <input type="text" id="last-name" name="last-name" required>
      </div>
      <div class="form-field">
        <label for="first-name" class="form-field-label">First Name:</label>
        <input type="text" id="first-name" name="first-name" required>
      </div>
      <div class="form-field">
        <label for="dealer-number-2" class="form-field-label">Agricultural Dealer Number:</label>
        <input type="text" id="dealer-number-2" name="dealer-number-2" required>
      </div>
      <div class="form-field">
        <label for="physical-address" class="form-field-label">Physical Address:</label>
        <input type="text" id="physical-address" name="physical-address" required>
      </div>
      <div class="form-field">
        <label for="start-date" class="form-field-label">Start Date:</label>
        <input type="text" id="start-date" name="start-date" required>
      </div>
      <div class="form-field">
        <label for="end-date" class="form-field-label">End Date:</label>
        <input type="text" id="end-date" name="end-date" required>
      </div>
    </div>

    <div class="form-section">
      <p>Done at: Bamako, on [date]</p>
      <p>Head of Legislation and Sanitary Control Division (DLCP)</p>
      <p>National Directorate of Agriculture</p>
      <p>(Stamp and signature)</p>
    </div>
  </div>
</body>
</html>
