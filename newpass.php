<?php
session_start();
include_once '../Model/user.php';
include_once '../Controller/userC.php';
$error = "";
$user = NULL;
$userC = new userC();

if (
  isset($_POST["pass"])
){
  if (
    !empty($_POST["pass"]) 
  ) {

    $userC->updatePass($_POST["pass"],$_GET['id']);
   
      header('Location:signin.php');
    
    
  }else
  echo 'missing Info';
}
?>

<link rel="stylesheet" href="css/css.css">

<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form method="POST">
            <h1>Enter Your New Password</h1>

            <input type="text" name="pass" placeholder="New Password" />

           
            <button type="submit">Change</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Welcome to creativity-crew</h1>
                <p>Don't Have an acount click here !</p>
                <a class="ghost" href="signup.php" id="signIn">Sign Up</a>
            </div>
        </div>
    </div>
</div>