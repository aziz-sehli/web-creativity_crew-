<?php
   
   
    require_once('../Controller/reclamationC.php');
    require_once ('../Model/reclamation.php');

    $error = "";
    // create user
    $reclamation = null;
    // create an instance of the controller
    $reclamationC = new reclamationC();
    if (
        isset($_POST["id"]) &&
        isset($_POST["name"]) &&
        isset($_POST["mail"]) &&
        isset($_POST["type"]) &&
        isset($_POST["message"]) &&
        isset($_POST["idRec"])
        
    ) {
        if (
            !empty($_POST["id"]) && 
            !empty($_POST["name"]) &&
            !empty($_POST["mail"]) &&
            !empty($_POST["type"]) &&
            !empty($_POST["message"]) &&
            !empty($_POST["idRec"])
            
        ) {
            $reclamation = new reclamation(
                $_POST['id'], 
                $_POST['name'],
                $_POST['mail'],
                $_POST['type'],
                $_POST['message'],
                $_POST['idRec']
            );
			$reclamationC->ajouterReclamation($reclamation);
      header ('Location:../View/tableRec.php');
        }
        else
            $error = "Missing information";
    }  
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud</title>
    <link rel="stylesheet" href="css/style.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <style>
        .error-message {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <form method="POST" name="form" onsubmit="return valider()">
        <h1>DEMANDE DE RECLAMATION</h1>
        <div class="separation"></div>
        <div class="corps-formulaire">
            <div class="gauche">
                <div class="groupe">
                    <label>Identifiant :</label>
                    <input type="text" autocomplete="off" placeholder="Identifiant" name="id" id="id"/>
                    <i class="fas fa-user"></i>
                    <div id="errorId" class="error-message"></div>
                </div>
                <div class="groupe">
                    <label>Nom :</label>
                    <input type="text" autocomplete="off" placeholder="Nom" name="name" id="name"/>
                    <i class="fas fa-user"></i>
                    <div id="errorName" class="error-message"></div>
                </div>
                <div class="groupe">
                    <label>Email :</label>
                    <input type="text" autocomplete="off" placeholder="Email" name="mail" id="mail"/>
                    <i class="fas fa-envelope"></i>
                    <div id="errorMail" class="error-message"></div>
                </div>
                <div class="groupe">
                    <label>Type :</label>
                    <input type="text" placeholder="Client" name="type" id="type">
                    <div id="errorType" class="error-message"></div>
                </div>
                <div class="groupe">
                    <label>ID à réclamer :</label>
                    <input type="text" placeholder="ID à réclamer" name="idRec" id="idRec">
                    <i class="fas fa-user"></i>
                    <div id="errorIdRec" class="error-message"></div>
                </div>
            </div>
            <div class="droite">
                <div class="groupe">
                    <label>Message</label>
                    <textarea placeholder="Saisissez ici..." name="message" id="message"></textarea>
                    <div id="errorMessage" class="error-message"></div>
                </div>
            </div>
        </div>
        <div class="gauche">
            <div class="pied-formulaire" align="center" name="submit" value="ok" min="1" max="500" required>
               <button type="submit">Envoyer le message</button>
            </div>
        </div>
    </form>

    <script>
        function valider() {
            var id = document.getElementById("id").value.trim();
            var name = document.getElementById("name").value.trim();
            var mail = document.getElementById("mail").value.trim();
            var type = document.getElementById("type").value.trim();
            var idRec = document.getElementById("idRec").value.trim();
            var message = document.getElementById("message").value.trim();
            var isValid = true;

            if (id === '') {
                document.getElementById("errorId").textContent = 'Saisissez l\'identifiant';
                isValid = false;
            } else {
                document.getElementById("errorId").textContent = '';
            }

            if (name === '') {
                document.getElementById("errorName").textContent = 'Saisissez votre nom';
                isValid = false;
            } else {
                document.getElementById("errorName").textContent = '';
            }

            if (mail === '') {
                document.getElementById("errorMail").textContent = 'Saisissez votre email';
                isValid = false;
            } else {
                document.getElementById("errorMail").textContent = '';
            }

            if (type === '') {
                document.getElementById("errorType").textContent = 'Saisissez le type';
                isValid = false;
            } else {
                document.getElementById("errorType").textContent = '';
            }

            if (idRec === '') {
                document.getElementById("errorIdRec").textContent = 'Saisissez l\'ID à réclamer';
                isValid = false;
            } else {
                document.getElementById("errorIdRec").textContent = '';
            }

            if (message === '') {
                document.getElementById("errorMessage").textContent = 'Saisissez le message';
                isValid = false;
            } else {
                document.getElementById("errorMessage").textContent = '';
            }

            return isValid;
        }
    </script>
</body>
</html>

