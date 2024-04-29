<?php
// Include the reservationC.php file
include '../controler/reservationC.php';
include '../model/reservation.php';
// Créer une nouvelle instance de la classe Reservation
$reservation = new Reservation(
    null, // Vous pouvez laisser cet argument null ou fournir la valeur appropriée
    $_POST['event_id'], // Récupérer l'ID de l'événement à partir du formulaire
    $_POST['participant_name'], // Récupérer le nom du participant à partir du formulaire
    $_POST['participant_email'], // Récupérer l'email du participant à partir du formulaire
    $_POST['participant_phone'], // Récupérer le numéro de téléphone du participant à partir du formulaire
    $_POST['num_of_people'], // Récupérer le nombre de personnes à partir du formulaire
    $_POST['reservation_status'] // Récupérer le statut de la réservation à partir du formulaire
);

// Maintenant, vous pouvez utiliser $reservation comme vous le souhaitez
?>
