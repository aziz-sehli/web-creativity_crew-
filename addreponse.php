<?php
    require_once '../Controller/reponseC.php';
    require_once '../Model/reponse.php';
    require_once '../Controller/reclamationC.php';

    $error = "";
    // create user
    $reponse = null;
    // create an instance of the controller
    $reclamationC= new reclamationC();
    $reponseC = new reponseC();
    if (
        isset($_POST["id"]) &&
        isset($_POST["reponse"]) &&
        isset($_POST["idd"]) 
        
    ) {
        if (
            !empty($_POST["id"]) && 
            !empty($_POST["reponse"])  && 
            !empty($_POST["idd"]) 
            
        )
         {
            $reponse = new reponse(
                $_POST['id'], 
                $_POST['reponse'], 
                $_POST['idd']
            );
			$reponseC->ajouterReponse($reponse);
      header ('Location:reponseadmin.php');
        }
        else
            $error = "Missing information";
    }  

    $liste=$reclamationC->afficherReclamation();
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
    
<form method="POST" onsubmit="return validateForm()">
    <h1>GESTION DES REPONSES</h1>
    <div class="separation"></div>
    <div class="corps-formulaire">
        <div class="gauche">
            <div class="groupe">
                <label>ID Reponse</label>
                <input type="text" autocomplete="off" placeholder="" name="id" id="id"/>
                <div id="errorId" class="error-message"></div>
            </div>
            <div class="groupe">
                <label>Reponse</label>
                <textarea autocomplete="off" placeholder="reponse" name="reponse" id="reponse"></textarea>
                <div id="errorReponse" class="error-message"></div>
            </div>
            <div class="groupe">
                <label>ID Reclamation :</label>
                <select name="idd" class="form-control p-6" id="idd">
                    <option value="">Select An ID</option>
                    <?php foreach($liste as $rec){ ?>
                    <option value="<?php echo $rec['id'] ?>"><?php echo $rec['id'] ?></option>
                    <?php } ?>
                </select>
                <div id="errorIdd" class="error-message"></div>
            </div>
        </div>
        <div class="gauche">
            <div class="pied-formulaire" align="center" name="submit" min="1" max="500" required >
                <button type="submit">Envoyer Reponse</button>
            </div>
        </div>
    </div>
</form>

<script>
    function validateForm() {
        var id = document.getElementById("id").value.trim();
        var reponse = document.getElementById("reponse").value.trim();
        var idd = document.getElementById("idd").value.trim();
        var isValid = true;

        if (id === '') {
            document.getElementById("errorId").textContent = 'Saisissez l\'ID Reponse';
            isValid = false;
        } else {
            document.getElementById("errorId").textContent = '';
        }

        if (reponse === '') {
            document.getElementById("errorReponse").textContent = 'Saisissez la reponse';
            isValid = false;
        } else {
            document.getElementById("errorReponse").textContent = '';
        }

        if (idd === '') {
            document.getElementById("errorIdd").textContent = 'Sélectionnez un ID Reclamation';
            isValid = false;
        } else {
            document.getElementById("errorIdd").textContent = '';
        }

        return isValid;
    }
</script>
</body>
</html>

