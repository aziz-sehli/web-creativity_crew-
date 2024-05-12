<?php
// Include necessary files and classes
include '../controler/reservationC.php';

// Check if the reservation data is set and not empty
if (isset($_POST["participant_name"]) &&
    isset($_POST["participant_email"]) &&
    isset($_POST["participant_phone"]) &&
    isset($_POST["num_of_people"]) &&
    !empty($_POST['participant_name']) &&
    !empty($_POST['participant_email']) &&
    !empty($_POST['participant_phone']) &&
    !empty($_POST['num_of_people'])) {

    // Create a new Reservation object
    $Reservationa = new Reservation(
        NULL,
        $_POST['event_id'],
        $_POST['participant_name'],
        $_POST['participant_email'],
        $_POST['participant_phone'],
        $_POST['num_of_people'],
        $STAT // I'm not sure where $STAT comes from, make sure it's defined
    );

    // Create a new ReservationC object
    $ReservationCa = new ReservationC();

    // Add the reservation
    $ReservationCa->addReservation($Reservationa);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Success</title>
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
            text-align: center;
        }
        h1 {
            color: #68BB59; /* Olive green */
        }
        p {
            color: #333333;
        }
        button {
            background-color: #68BB59; /* Olive green */
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #5A9E4C; /* Darker shade of olive green */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reservation Successful!</h1>
        <p>Your reservation has been successfully made.</p>
        
        <!-- Add a button to delete the reservation -->
        <form action="delete_reservation.php" method="post">
            <!-- Pass the reservation ID to delete_reservation.php -->
            <input type="hidden" name="reservation_id" value="<?php echo $Reservationa->getId(); ?>">
            <!-- Submit button for deleting the reservation -->
            <button type="submit" name="delete_reservation">Delete Reservation</button>
        </form>
    </div>
</body>
</html>

