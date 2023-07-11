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
</head>
<body>
  <h2>SEED PRODUCER REGISTRATION CARD</h2>

  <label for="from">FROM: (LABOSEM, SOCQC/OPA)</label><br>
 
  <label for="date">DATE: {{$today}}</label><br>

  <label for="application-number">APPLICATION NUMBER: {{$form->producer_registration_number}}</label><br>
  <p></p>

  <p>Your Application number {{$form->producer_registration_number}}, requesting seed operator approval, has been approved.</p>
  <p>Enclosed is the appraisal report.</p>
  <p>You may appeal this decision in accordance with the regulations in force.</p>

  <br>

  <p>______________________________</p>
  <p>SIGNATURE OF LABOSEM MANAGER</p>
  <p>SOCQC/OPA</p>
  
</body>
</html>
