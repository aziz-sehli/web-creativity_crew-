<?php
include '../controler/reservationC.php';
$reservationC = new reservationC();

// Tri des réservations par le nombre de personnes
$listeTriee = $reservationC->sortReservationsByNumOfPeople();

// Génération du HTML pour la table des réservations
$html = '';
foreach ($listeTriee as $reservation) {
    $html .= '<tr>';
    $html .= '<td>' . $reservation['reservation_id'] . '</td>';
    $html .= '<td>' . $reservation['participant_name'] . '</td>';
    $html .= '<td>' . $reservation['participant_email'] . '</td>';
    $html .= '<td>' . $reservation['participant_phone'] . '</td>';
    $html .= '<td>' . $reservation['num_of_people'] . '</td>';
    // Ajoutez les autres colonnes de la table si nécessaire
    $html .= '</tr>';
}

// Retournez le HTML généré
echo $html;
?>
