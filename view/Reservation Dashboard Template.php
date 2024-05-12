<?php
include '../controler/reservationC.php';

$Reservationa = NULL;
$STAT = "";
$INT = 1;
$ReservationCa = new ReservationC();

// Fonction pour nettoyer et valider les données d'entrée
function sanitizeInput($data) {
    $data = trim($data); // Supprimer les espaces vides au début et à la fin de l'entrée
    $data = stripslashes($data); // Supprimer les barres obliques inverses (\)
    $data = htmlspecialchars($data); // Convertir les caractères spéciaux en entités HTML pour éviter les attaques XSS
    return $data;
}

// Fonction pour valider le numéro de téléphone
function validatePhoneNumber($phone) {
    // Vérifier si le numéro de téléphone est composé de chiffres uniquement et a une longueur de 8 chiffres
    return preg_match('/^\d{8}$/', $phone);
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider et nettoyer les données d'entrée
    $participant_name = sanitizeInput($_POST["participant_name"]);
    $participant_email = sanitizeInput($_POST["participant_email"]);
    $participant_phone = sanitizeInput($_POST["participant_phone"]);
    $num_of_people = sanitizeInput($_POST["num_of_people"]);
    $event_id = sanitizeInput($_POST["event_id"]);

    // Vérifier si tous les champs sont remplis
    if (!empty($participant_name) && !empty($participant_email) && !empty($participant_phone) && !empty($num_of_people) && !empty($event_id)) {
        // Valider le numéro de téléphone
        if (validatePhoneNumber($participant_phone)) {
            // Créer un objet réservation
            $Reservationa = new Reservation(NULL, $event_id, $participant_name, $participant_email, $participant_phone, $num_of_people, $STAT);

            // Ajouter la réservation
            $ReservationCa->addReservation($Reservationa);

            // Rediriger vers reservation_success.php après une réservation réussie
            header('Location: reservation_success.php');
            exit; // Assurer qu'aucune autre sortie n'est envoyée
        } else {
            // Gérer l'erreur de numéro de téléphone invalide
            echo "Invalid phone number. Please enter a valid 8-digit number.";
        }
    } else {
        // Gérer l'erreur de champs vides
        echo "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Dashboard Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333333;
        }
        .reservation-form {
            margin-top: 30px;
        }
        label {
            font-weight: bold;
            color: #333333;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reservation Dashboard</h1>
        <div class="reservation-form">
            <h2>Make a Reservation</h2>
            <form action='' method='POST'>
                <label for='event_id'>Event ID:</label>
                <input type='text' id='event_id' name='event_id' required><br>
                <label for='participant_name'>Your Name:</label>
                <input type='text' id='participant_name' name='participant_name' required><br>
                <label for='participant_email'>Your Email:</label>
                <input type='email' id='participant_email' name='participant_email' required><br>
                <label for='participant_phone'>Your Phone:</label>
                <input type='text' id='participant_phone' name='participant_phone' required><br>
                <label for='num_of_people'>Number of People:</label>
                <input type='number' id='num_of_people' name='num_of_people' required><br>
                <input type='submit' value='Submit Reservation'>
            </form>
        </div>
    </div>
</body>
</html>
