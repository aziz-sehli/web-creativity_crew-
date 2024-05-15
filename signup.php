<?php
session_start();
include_once '../Model/user.php';
include_once '../Controller/userC.php';
$error = "";
$user = NULL;
$userC = new userC();

if (
    isset($_POST["nom1"]) &&
    isset($_POST["prenom1"]) &&
    isset($_POST["email1"]) &&
    isset($_POST["phone1"]) &&
    isset($_POST["pass1"]) &&
    isset($_POST["add1"]) &&
    isset($_POST["mat"])
) {
    if (
        !empty($_POST["nom1"]) &&
        !empty($_POST["prenom1"]) &&
        !empty($_POST["email1"]) &&
        !empty($_POST["pass1"]) &&
        !empty($_POST["add1"]) &&
        !empty($_POST["mat"])
    ) {
        // Validate phone number
        $phone1 = $_POST["phone1"];
        if (!is_numeric($phone1) || strlen($phone1) !== 8) {
            echo '<p style="color: red;">Invalid phone number. Please enter a valid 8-digit phone number.</p>';
        } else {
            // Check if email or phone number already exists
            if ($userC->emailExists($_POST["email1"]) || $userC->phoneExists($phone1)) {
                echo '<p style="color: red;">Email or phone number already in use. Please choose a different one.</p>';
            } else {
                $condidat = new condidat(
                    0,
                    $_POST['nom1'],
                    $_POST['prenom1'],
                    $_POST['email1'],
                    $phone1,
                    $_POST['pass1'],
                    "etudiant",
                    $_POST['mat'],
                    $_POST['add1']
                );
                $userC->ajoutercondidat($condidat);
                header('Location:signin.php');
            }
        }
    } else {
        echo 'missing Info';
    }
} else if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["phone"]) &&
    isset($_POST["pass"]) &&
    isset($_POST["spec"]) &&
    isset($_POST["cv"]) &&
    isset($_POST["wadd"])
) {
    if (
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["pass"]) &&
        !empty($_POST["spec"]) &&
        !empty($_POST["cv"]) &&
        !empty($_POST["wadd"])
    ) {
        // Validate phone number
        $phone = $_POST["phone"];
        if (!is_numeric($phone) || strlen($phone) !== 8) {
            echo '<p style="color: red;">Invalid phone number. Please enter a valid 8-digit phone number.</p>';
        } else {
            // Check if email or phone number already exists
            if ($userC->emailExists($_POST["email"]) || $userC->phoneExists($phone)) {
                echo '<p style="color: red;">Email or phone number already in use. Please choose a different one.</p>';
            } else {
                $societe = new societe(
                    0,
                    $_POST['nom'],
                    $_POST['prenom'],
                    $_POST['email'],
                    $phone,
                    $_POST['pass'],
                    "societe",
                    $_POST['cv'],
                    $_POST['spec'],
                    $_POST['wadd']
                );
                $userC->ajoutersociete($societe);
                header('Location:signin.php');
            }
        }
    } else {
        echo 'missing Info';
    }
}
?>



<link rel="stylesheet" href="css/css.css">

<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form method="POST">
            <h1>Create Account: societe</h1>

            <input type="text" name="nom" placeholder="Name" />
            <input type="text" name="prenom" placeholder="Last Name" />
            <input type="email" name="email" placeholder="Email" />
            <input type="text" name="phone" placeholder="Phone" />
            <input type="password" name="pass" placeholder="Password" />
            <input type="text" name="wadd" placeholder="Address" />
            <select type="text" name="spec">
                <option value="option1">technologie</option>
                <option value="option2">business</option>
                <option value="option3">finance</option>
                <option value="option4">marketing</option>
                <option value="option4">art</option>
            </select>
            <input type="file" name="cv">
            <button type="submit">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form method="POST">
            <h1>Create Account: condidat</h1>

            <input type="text" name="nom1" placeholder="Name" />
            <input type="text" name="prenom1" placeholder="Last Name" />
            <input type="email" name="email1" placeholder="Email" />
            <input type="text" name="phone1" placeholder="Phone" />
            <input type="password" name="pass1" placeholder="Password" />
            <input type="text" name="add1" placeholder="Address" />
            <input type="text" name="job" placeholder="job" />
            <button type="submit">Sign Up</button>
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h2>Not a societe ? <br> want to join ?</h2>
                <p>Then join us now !</p>
                <button class="ghost" id="signIn">Sign Up</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h2>Are you a societe ?</h2>
                <p>Join our team and start journey with us !</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });

</script>