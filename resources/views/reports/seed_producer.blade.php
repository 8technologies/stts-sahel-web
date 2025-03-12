<?php
$link = public_path('css/bootstrap-print.css');
$form = App\Models\SeedProducer::find($_GET['id']);
// Obtenir la date actuelle
$aujourdHui = date("j F Y");
?>
<!DOCTYPE html>
<html>
<head>
  <title>CARTE D'ENREGISTREMENT DU PRODUCTEUR DE SEMENCES</title>
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
  {{-- <img src="{{ public_path('storage/assets/logo.png') }}" alt="logo"> --}}
  <img src="{{ public_path('/storage/assets/Republique Du Mali Logo.png') }}" width="50%" alt="logo">
  
  </div>
  <div class="card">
    <h2>CARTE D'ENREGISTREMENT DU PRODUCTEUR DE SEMENCES</h2>

    <label for="category">CATÉGORIE DU PRODUCTEUR :Société de semences </label><br>
    <label for="date">DATE : {{$aujourdHui}}</label><br>
    <label for="date">VALIDITÉ : de {{$form->valid_from}} à {{$form->valid_until}} </label><br>

    <label for="application-number">NUMÉRO DE LA DEMANDE : {{$form->producer_registration_number}}</label><br>
    <p></p>

    <p>Votre demande numéro {{$form->producer_registration_number}}, demandant l'approbation en tant qu'opérateur de semences, a été approuvé.</p>
    <p>Vous trouverez ci-joint le rapport d'évaluation.</p>
    <p>Vous pouvez contester cette décision conformément à la réglementation en vigueur.</p>


    <br>

    <p>SIGNATURE DU DIRECTEUR DE DCCS</p>
   
    <div>
      <img src="{{ public_path('storage/assets/signature.png') }}" alt="logo" width="200" height="100">
    </div>
  </div>
</div>
</body>
</html>
