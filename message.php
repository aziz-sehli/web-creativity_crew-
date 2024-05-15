<?php
require_once('../View/config.php'); // Include the configuration file

// Function to get response from the database
function getResponseFromDB($input) {
    // Create an instance of the config class to establish a database connection
    $config = new config();
    $pdo = $config->getConnexion();

    // Prepare SQL statement to select reply based on the user query
    $query = "SELECT replies FROM chatbot WHERE queries LIKE :input";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['input' => "%$input%"]);

    if ($stmt->rowCount() > 0) {
        // If a match is found, return the reply
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['replies'];
    } else {
        // If no match is found, return a default response
        return "Sorry, can't understand you!";
    }
}

// Check if 'text' parameter is received through POST request
if(isset($_POST['text'])) {
    // Get user input
    $user_input = $_POST['text'];

    // Get response from the database
    $response = getResponseFromDB($user_input);

    // Output response
    echo $response;
}
?>
