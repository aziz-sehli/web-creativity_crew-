<?php
include '../Controller/eventC.php';

$error = "";

// create Event
$event = null;

// create an instance of the controller
$eventC = new eventC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["event_name"]) &&
        isset($_POST["event_description"]) &&
        isset($_POST["event_date"]) &&
        isset($_POST["event_location"]) &&
        isset($_POST["event_organizer"])
    ) {
        if (
            !empty($_POST["event_name"]) &&
            !empty($_POST["event_description"]) &&
            !empty($_POST["event_date"]) &&
            !empty($_POST["event_location"]) &&
            !empty($_POST["event_organizer"])
        ) {
            // Create Event instance
            $event = new event(
                null,
                $_POST['event_name'],
                $_POST['event_description'],
                new DateTime($_POST['event_date']),
                $_POST['event_location'],
                $_POST['event_organizer']
            );

            // Add Event to the controller
            $eventC->addevent($event);

            // Redirect to the indexx.php page
            header('Location: indexx.php');
            exit(); // Make sure to exit after header to avoid further execution
        } else {
            $error = "Missing information";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
</head>

<body>
    <h2>Add Event</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="event_name">Event Name:</label><br>
        <input type="text" id="event_name" name="event_name" value="<?php if(isset($_POST['event_name'])) echo $_POST['event_name']; ?>"><br>

        <label for="event_description">Event Description:</label><br>
        <input type="text" id="event_description" name="event_description" value="<?php if(isset($_POST['event_description'])) echo $_POST['event_description']; ?>"><br>

        <label for="event_date">Event Date:</label><br>
        <input type="date" id="event_date" name="event_date" value="<?php if(isset($_POST['event_date'])) echo $_POST['event_date']; ?>"><br>

        <label for="event_location">Event Location:</label><br>
        <input type="text" id="event_location" name="event_location" value="<?php if(isset($_POST['event_location'])) echo $_POST['event_location']; ?>"><br>

        <label for="event_organizer">Event Organizer:</label><br>
        <input type="text" id="event_organizer" name="event_organizer" value="<?php if(isset($_POST['event_organizer'])) echo $_POST['event_organizer']; ?>"><br><br>

        <input type="submit" value="Submit">
    </form>
    <p><?php echo $error; ?></p>
</body>

</html>
