<?php
$link = public_path('css/bootstrap-print.css');
$form = App\Models\SeedProducer::find($_GET['id']);
//get current date
$today = date("F j, Y");
?>
<!DOCTYPE html>
<html>
<head>
  <title>SEED PRODUCER REGISTRATION CARD</title>
  <style>
    /* Center the page content */
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .card-container {
      text-align: center;
    }

    .card {
      text-align: center;
      padding: 20px;
      border: 1px solid #ccc;
      max-width: 600px;
      background-color: #f9f9f9;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header img {
      max-width: 100%;
    }
  </style>
</head>
<body>
<div class="card-container">
  <div class="header">
  <img src="{{ public_path('storage/assets/logo.png') }}" alt="logo">
  </div>
  <div class="card">
    <h2>SEED PRODUCER REGISTRATION CARD</h2>

    <label for="from">FROM: (LABOSEM, SOCQC/OPA)</label><br>
    <label for="category">PRODUCER CATEGORY:{{$form->producer_category}}</label><br>
    <label for="date">DATE: {{$today}}</label><br>
    <label for="date">VALIDITY:from {{$form->valid_from}} to {{$form->valid_until}} </label><br>


    <label for="application-number">APPLICATION NUMBER: {{$form->producer_registration_number}}</label><br>
    <p></p>

    <p>Your Application number {{$form->producer_registration_number}}, requesting seed operator approval, has been approved.</p>
    <p>Enclosed is the appraisal report.</p>
    <p>You may appeal this decision in accordance with the regulations in force.</p>

    <br>

    <p>______________________________</p>
    <p>SIGNATURE OF LABOSEM MANAGER</p>
    <p>SOCQC/OPA</p>
  </div>
</div>
</body>
</html>
