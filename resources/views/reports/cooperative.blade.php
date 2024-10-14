<?php
$link = public_path('css/bootstrap-print.css');
$form = App\Models\Cooperative::find($_GET['id']);
// Obtention de la date actuelle
$aujourdHui = date("j F Y");
?>
<!DOCTYPE html>
<html>
<head>
  <title>CARTE D'ENREGISTREMENT DE LA COOPÉRATIVE</title>
  <style>
    /* Centrer le contenu de la page */
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
  <div class="header">CARTE D'ENREGISTREMENT DE LA COOPÉRATIVE</div>

<div class="content">
  <p>DE : DCCS, SOCQC/OPA</p>
  <p>DATE : {{$form->updated_at}}</p>
  <p>NUMÉRO DE DEMANDE : {{$form->registration_number}} </p>
  <br>
  <p>Votre demande numéro {{$form->registration_number}}, demandant l'approbation de l'opérateur de semences, a été approuvé. Ci-joint se trouve le rapport d'évaluation.
     Vous pouvez contester cette décision conformément à la réglementation en vigueur.</p>
</div>

<div class="signature">
<p>SIGNATURE DU DIRECTEUR DE DCCS</p>
  
    <div>
      <img src="{{ public_path('storage/assets/signature.png') }}" alt="logo" width="200" height="100">
    </div>
</div>
  </div>
</div>
</body>
</html>
