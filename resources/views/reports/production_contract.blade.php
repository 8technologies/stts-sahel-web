<!DOCTYPE html>
<html>
<head>
  <title>Seed Declaration Form</title>
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
    <div class="form-heading">Production Contract</div>

    <div class="form-section">
      <div class="form-field">
        <label for="declaration-number" class="form-field-label">N°:</label>
        <input type="text" id="declaration-number" name="declaration-number" required>
      </div>
      <div class="form-field">
        <label for="company" class="form-field-label">Company:</label>
        <input type="text" id="company" name="company" required>
      </div>
      <div class="form-field">
        <label for="address" class="form-field-label">Address:</label>
        <input type="text" id="address" name="address" required>
      </div>
      <div class="form-field">
        <label for="phone" class="form-field-label">Phone:</label>
        <input type="text" id="phone" name="phone" required>
      </div>
      <div class="form-field">
        <label for="fax" class="form-field-label">Fax:</label>
        <input type="text" id="fax" name="fax">
      </div>
      <div class="form-field">
        <label for="email" class="form-field-label">E-mail:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-field">
        <label for="seed-technician" class="form-field-label">Name of Seed Technician:</label>
        <input type="text" id="seed-technician" name="seed-technician" required>
      </div>
    </div>

    <div class="form-section">
      <div class="form-heading">Multiplier Farmer</div>
      <div class="form-field">
        <label for="multiplier-name" class="form-field-label">Name:</label>
        <input type="text" id="multiplier-name" name="multiplier-name" required>
      </div>
      <div class="form-field">
        <label for="multiplier-first-name" class="form-field-label">First name:</label>
        <input type="text" id="multiplier-first-name" name="multiplier-first-name" required>
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
        <label for="generation" class="form-field-label">Generation:</label>
        <input type="text" id="generation" name="generation" required>
      </div>
      <div class="form-field">
        <label for="region" class="form-field-label">Region:</label>
        <input type="text" id="region" name="region" required>
      </div>
      <div class="form-field">
        <label for="circle" class="form-field-label">Circle:</label>
        <input type="text" id="circle" name="circle" required>
      </div>
      <div class="form-field">
        <label for="town" class="form-field-label">Town:</label>
        <input type="text" id="town" name="town" required>
      </div>
      <div class="form-field">
        <label for="village" class="form-field-label">Village/Neighborhood/Street:</label>
        <input type="text" id="village" name="village" required>
      </div>
      <div class="form-field">
        <label for="postal-address" class="form-field-label">Postal Address:</label>
        <input type="text" id="postal-address" name="postal-address" required>
      </div>
      <div class="form-field">
        <label for="multiplier-phone" class="form-field-label">Phone:</label>
        <input type="text" id="multiplier-phone" name="multiplier-phone" required>
      </div>
      <div class="form-field">
        <label for="multiplier-fax" class="form-field-label">Fax:</label>
        <input type="text" id="multiplier-fax" name="multiplier-fax">
      </div>
      <div class="form-field">
        <label for="multiplier-email" class="form-field-label">E-mail:</label>
        <input type="email" id="multiplier-email" name="multiplier-email" required>
      </div>
      <div class="form-field">
        <label for="crop-declaration-no" class="form-field-label">Crop Declaration No.:</label>
        <input type="text" id="crop-declaration-no" name="crop-declaration-no" required>
      </div>
      <div class="form-field">
        <label for="harvest-year" class="form-field-label">Harvest Year:</label>
        <input type="text" id="harvest-year" name="harvest-year" required>
      </div>
    </div>
  </div>
</body>
</html>
