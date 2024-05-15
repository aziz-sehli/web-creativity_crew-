<?php
session_start();
include_once '../Model/user.php';
include_once '../Controller/userC.php';
$error = "";
$user = NULL;
$userC = new userC();

if (isset($_POST["code"])) {
    if (!empty($_POST["code"])) {

        $check = $userC->check2($_POST["code"]);
        if ($check != 0) {
            $userC->deleteTok($_GET["id"]);
            header('Location:newpass.php?id=' . $_GET['id']);
        } else {
            $error = 'Invalid code. Please try again.';
        }

    } else {
        $error = 'Missing code.';
    }
}
?>

<link rel="stylesheet" href="css/style.css">

<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form method="POST">
            <h1>Enter the Code</h1>

            <?php
            if (!empty($error)) {
                echo '<p style="color: red;">' . $error . '</p>';
            }
            ?>

            <input type="text" name="code" placeholder="code" />
            <button type="submit">Confirm</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Welcome to creativity-crew </h1>
                <p>Don't Have an account click here!</p>
                <a class="ghost" href="signup.php" id="signIn">Sign Up</a>
            </div>
        </div>
    </div>
</div>
