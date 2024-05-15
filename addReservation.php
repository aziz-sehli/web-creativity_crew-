<?php
// Include the necessary files
include '../Controller/reservationC.php';
include_once("../Model/reservation.php");

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new ReservationC object
    $reservationC = new ReservationC();

    // Create a new Reservation object with form data
    $reservation = new Reservation(
        NULL,
        $_POST['event_id'],
        $_POST['participant_name'],
        $_POST['participant_email'],
        $_POST['participant_phone'],
        $_POST['num_of_people'],
        $STAT // Assuming $STAT is defined somewhere in your code
    );

    // Add the reservation
    $reservationC->addReservation($reservation);

    // Redirect to a success page or wherever appropriate
    header('Location: success.php');
    exit(); // Stop further execution of the script
}
?>

