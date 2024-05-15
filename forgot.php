<?php
session_start();
include_once '../Model/user.php';
include_once '../Controller/userC.php';
$error = "";
$user = NULL;
$userC = new userC();

if (isset($_POST["phone"])) {
    if (!empty($_POST["phone"])) {

        // Check if the phone number is valid (you may need to adjust this validation)
        if (preg_match('/^[0-9]{8}$/', $_POST["phone"])) {
            $check = $userC->check($_POST["phone"]);
            if ($check != 0) {
                $userC->test($check["id"]);
                header('Location:code.php?id=' . $check['id']);
            } else {
                $error = 'Invalid phone number. Please try again.';
            }
        } else {
            $error = 'Invalid phone number format. Please enter a valid 8-digit phone number.';
        }

    } else {
        $error = 'Missing phone number.';
    }
}
?>

<link rel="stylesheet" href="css/css.css">

<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form method="POST">
            <h1>Enter your Phone</h1>

            <?php
            if (!empty($error)) {
                echo '<p style="color: red;">' . $error . '</p>';
            }
            ?>

            <input type="text" name="phone" placeholder="Phone" />
            <a href="forgot.php">Forgot your password?</a>
            <button type="submit">Send Code</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Welcome to Allergicare</h1>
                <p>Don't Have an account click here!</p>
                <a class="ghost" href="signup.php" id="signIn">Sign Up</a>
            </div>
        </div>
    </div>
</div>
