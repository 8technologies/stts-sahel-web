<!DOCTYPE html>
<html>
<head>
  <title>Seed Order Notification</title>
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
    <div class="form-heading">SEED ORDER NOTIFICATION</div>

    <div class="form-section">
      <div class="form-field">
        <label for="order-number" class="form-field-label">Seed Order Number:</label>
        <input type="text" id="order-number" name="order-number" required>
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
        <label for="quantity" class="form-field-label">Quantity:</label>
        <input type="text" id="quantity" name="quantity" required>
      </div>
      <div class="form-field">
        <label for="repacking" class="form-field-label">Repacking (Vendor Orientation):</label>
        <input type="text" id="repacking" name="repacking" required>
      </div>
      <div class="form-field">
        <label for="delivery-date" class="form-field-label">Preferred Delivery Date:</label>
        <input type="text" id="delivery-date" name="delivery-date" required>
      </div>
      <div class="form-field">
        <label for="customer-name" class="form-field-label">Customer Name:</label>
        <input type="text" id="customer-name" name="customer-name" required>
      </div>
      <div class="form-field">
        <label for="payment-methods" class="form-field-label">Preferred Payment Methods:</label>
        <input type="text" id="payment-methods" name="payment-methods" required>
      </div>
      <div class="form-field">
        <label for="delivery-preferences" class="form-field-label">Seed Delivery Preferences:</label>
        <input type="text" id="delivery-preferences" name="delivery-preferences" required>
      </div>
      <div class="form-field">
        <label for="signature" class="form-field-label">Signature:</label>
        <input type="text" id="signature" name="signature" required>
      </div>
    </div>
  </div>
</body>
</html>
