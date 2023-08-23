<?php
$link = public_path('css/bootstrap-print.css');
$form = App\Models\AgroDealers::find($_GET['id']);

// Obtenir la date actuelle
$aujourdHui = date("j F Y");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Certificat d'Enregistrement</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .card {
      border: 1px solid #ccc;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      text-align: center;
      background-color: #f9f9f9;
    }
    .card-header {
      background-image: url('chemin_vers_votre_image.jpg');
      background-size: cover;
      background-position: center;
      height: 150px;
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
    }
    .form-heading {
      font-size: 24px;
      font-weight: bold;
      color: white;
      padding: 20px;
      margin: 0;
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
  <div class="card">
    <div class="card-header">
    <img src="{{ public_path('storage/assets/logo.png') }}" alt="logo">
    </div>
    <div class="form-section">
      <div class="form-field">
        <label for="dealer-number" class="form-field-label">Numéro de l'Agrocommerçant : {{$form->agro_dealer_reg_number}}</label>
       
      </div>
      <div class="form-field">
        <label for="last-name" class="form-field-label">Nom de Famille : {{$form->last_name}}</label>
       
      </div>
      <div class="form-field">
        <label for="first-name" class="form-field-label">Prénom : {{$form->first_name}}</label>
       
      </div>
      
      <div class="form-field">
        <label for="physical-address" class="form-field-label">Adresse Physique : {{$form->physical_address}}</label>
     
      </div>
      <div class="form-field">
        <label for="start-date" class="form-field-label">Date de Début : {{$form->valid_from}}</label>
       
      </div>
      <div class="form-field">
        <label for="end-date" class="form-field-label">Date de Fin : {{$form->valid_until}}</label>
      
      </div>
      <div class="form-section">
      <p>Fait à Bamako, le [date]</p>
      <p>Chef de la Division de Législation et de Contrôle Sanitaire (DLCP)</p>
      <p>Direction Nationale de l'Agriculture</p>
      <p>(Tampon et signature)</p>
    </div>
    </div>
    </div>
  
  </div>
</body>
</html>


