<?php
include '../controler/reservationC.php';

$Reservationa = NULL;
$STAT = "";
$INT=1;
$ReservationCa = new ReservationC();

if (
    isset($_POST["participant_name"]) &&
    isset($_POST["participant_email"]) &&
    isset($_POST["participant_phone"]) &&
    isset($_POST["num_of_people"])
) {
    if (
        !empty($_POST['participant_name']) &&
        !empty($_POST['participant_email']) &&
        !empty($_POST['participant_phone']) &&
        !empty($_POST['num_of_people'])
    ) {
        $Reservationa = new Reservation(
            NULL,
            $_POST['event_id'],
            $_POST['participant_name'],
            $_POST['participant_email'],
            $_POST['participant_phone'],
            $_POST['num_of_people'],
            $STAT
        );
        $ReservationCa->addReservation($Reservationa);
            // Redirect to reservation_success.php after successful reservation
        header('Location: reservation_success.php');
        exit; // Ensure no further output is sent
    } 
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Dashboard Template</title>
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Reservation Dashboard</h1>
        <div class="reservation-form">
            <h2>Make a Reservation</h2>
            <?php

                echo "<form action='' method='POST'>";
                echo "<label for='event_id'>event_id:</label>";
                echo "<input type='text' id='event_id' name='event_id' required><br><br>";
                echo "<label for='participant_name'>Your Name:</label>";
                echo "<input type='text' id='participant_name' name='participant_name' required><br><br>";
                echo "<label for='participant_email'>Your Email:</label>";
                echo "<input type='email' id='participant_email' name='participant_email' required><br><br>";
                echo "<label for='participant_phone'>Your Phone:</label>";
                echo "<input type='text' id='participant_phone' name='participant_phone' required><br><br>";
                echo "<label for='num_of_people'>Number of People:</label>";
                echo "<input type='number' id='num_of_people' name='num_of_people' required><br><br>";
                echo "<input type='submit' value='Submit Reservation'>";
                echo "</form>";
            
            ?>
        </div>
    </div>
</body>
</html>
