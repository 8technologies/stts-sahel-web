<?php
$link = public_path('css/bootstrap-print.css');
$form = App\Models\AgroDealers::find($_GET['id']);
// Obtenir la date actuelle
$aujourdHui = date("j F Y");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificat d'Enregistrement</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
<div class="card-container">
  <div class="header">
  <img src="{{ public_path('storage/assets/logo.png') }}" alt="logo">
  </div>
  <div class="card">
        <h2 class="text-center">Certificat d'Enregistrement</h2>

        <form class="mt-4">
            <div class="mb-3">
                <label for="dealerNumber" class="form-label">Numéro de Négociant Agricole : {{$form->agro_dealer_reg_number}}</label>
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">Nom : {{$form->last_name}}</label>
                
            </div>

            <div class="mb-3">
                <label for="firstName" class="form-label">Prénom : {{$form->first_name}}</label>
            
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Adresse Physique : {{$form->physical_address}}</label>
            
            </div>

            <div class="mb-3">
                <label for="startDate" class="form-label">Date de Début : {{$form->valid_from}}</label>
                
            </div>

            <div class="mb-3">
                <label for="endDate" class="form-label">Date de Fin : {{$form->valid_until}}</label>
                
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Fait à :Niger, {{$form->updated_at}}</label>
                
            </div>

            <div class="text-center mt-5">
                <p>Chef de la Division Législation et Contrôle Sanitaire (DLCP)</p>
                <p>Direction Nationale de l'Agriculture</p>
                <div>
                <img src="{{ public_path('storage/assets/signature.png') }}" alt="logo" width="200" height="100">
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS (Optional for interactive components) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
