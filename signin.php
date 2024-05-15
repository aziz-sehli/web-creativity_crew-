<?php
session_start();
include_once '../Model/user.php';
include_once '../Controller/userC.php';
$error = "";
$user = NULL;
$userC = new userC();

$errorMessage = "";

if (isset($_POST["email"]) && isset($_POST["pass"])) {
    if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
        $check = $userC->connexionUser($_POST["email"], $_POST["pass"]);
        if ($check != 0) {
            $_SESSION['email'] = $_POST["email"];
            $_SESSION['pass'] = $_POST["pass"];
            $_SESSION['fname'] = $check["nom"];
            $_SESSION['lname'] = $check["prenom"];
            $_SESSION['phone'] = $check["phone"];
            $_SESSION['role'] = $check["role"];
            $_SESSION['id'] = $check["id"];

            $spec = $userC->retrieveUser($check["id"], $check["role"]);

            if ($check["role"] == "condidat") {
                $_SESSION['job'] = $spec["job"];
                $_SESSION['add'] = $spec["address"];
                header('Location:index.php');
                exit(); // Add exit after header to stop further execution
            } elseif ($check["role"] == "professeure") {
                $_SESSION['cv'] = $spec["cv"];
                $_SESSION['spec'] = $spec["specialite"];
                $_SESSION['wadd'] = $spec["workAdress"];
                header('Location:index.php');
                exit(); // Add exit after header to stop further execution
            } elseif ($check["role"] == "admin") {
                header('Location:back/index.php');
                exit(); // Add exit after header to stop further execution
            }
        } else {
            $errorMessage = 'Invalid email or password';
        }
    } else {
        $errorMessage = 'Missing email or password';
    }
}
?>

<link rel="stylesheet" href="css/css.css">

<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form method="POST">
            <h1>Sign in</h1>

            <input type="email" name="email" placeholder="Email" />

            <input type="password" name="pass" placeholder="Password" />
            <a href="forgot.php">Forgot your password?</a>
            <?php
            if ($errorMessage != "") {
                echo '<p style="color: red;">' . $errorMessage . '</p>';
            }
            ?>
            <button type="submit">Sign In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Welcome to creativty-crew</h1>
                <p>Don't have an account? <a href="signup.php" id="signIn">Sign Up</a></p>
            </div>
        </div>
    </div>
</div>
