<?php
    require_once 'C:/xampp/htdocs/dist/Controller/jobOfferC.php';
    require_once 'C:/xampp/htdocs/dist/Model/Job.php';

    $error = "";
    // create job offer
    $jobOffer = null;
    // create an instance of the controller
    $jobOfferC = new JobOfferC();
    if (
        isset($_POST["id_job_offers"]) &&
        isset($_POST["id_entreprise"]) &&
        isset($_POST["id_recruteur"]) &&
        isset($_POST["id_category"]) &&
        isset($_POST["date"]) &&
        isset($_POST["titre"]) &&
        isset($_POST["description"]) &&
        isset($_POST["competence_requis"]) &&
        isset($_POST["experience"]) &&
        
        isset($_POST["lieu_travail"])
    ) {
        if (
            !empty($_POST["id_job_offers"]) && 
            !empty($_POST["id_entreprise"]) &&
            !empty($_POST["id_recruteur"]) &&
            !empty($_POST["id_category"]) &&
            !empty($_POST["date"]) &&
            !empty($_POST["titre"]) &&
            !empty($_POST["description"]) &&
            !empty($_POST["competence_requis"]) &&
            !empty($_POST["experience"]) &&
            
            !empty($_POST["lieu_travail"])
        ) {
            $jobOffer = new Job(
                $_POST['id_job_offers'], 
                $_POST['id_entreprise'],
                $_POST['id_recruteur'],
                $_POST['id_category'],
                $_POST['date'],
                $_POST['titre'],
                $_POST['description'],
                $_POST['competence_requis'],
                $_POST['experience'],
                
                $_POST['lieu_travail']
            );
            $jobOfferC->addJobOffer($jobOffer);
            header('Location:../View/tableJobu.php');
        }
        else
            $error = "Missing information";
    }  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Job Offer Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="background-image">
        <div class="container">
            <div class="text">Job Offer Form</div>
            <form method="post" action="/dist/View/add.php" enctype="multipart/form-data" onsubmit="return valider()" novalidate>
                <div class="form-row">
                    <div class="input-data">
                        <input type="text" required name="id_job_offers">
                        <div class="underline"></div>
                        <label for="id_job_offers">id_offer</label>
                    </div>
                    <div class="input-data">
                        <input type="date" required name="date">
                        <div class="underline"></div>
                        <label for="date">date limite</label>
                    </div>
                    <div class="input-data">
                        <input type="text" required name="titre">
                        <div class="underline"></div>
                        <label for="titre">titre du poste</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <input type="text" required name="lieu_travail">
                        <div class="underline"></div>
                        <label for="lieu_travail">lieu de travail</label>
                    </div>
                    <div class="input-data">
                        <input type="text" required name="experience">
                        <div class="underline"></div>
                        <label for="experience">niveau d'expérience requis</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data textarea">
                        <textarea rows="8" cols="80" required name="description"></textarea>
                        <br>
                        <div class="underline"></div>
                        <label for="description">description de l'offre</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data textarea">
                        <textarea rows="8" cols="80" required name="competence_requis"></textarea>
                        <br>
                        <div class="underline"></div>
                        <label for="competence_requis">compétences requises</label>
                    </div>
                </div>
                
                <div class="form-row">
                <label for="categorySelect">Category:</label>
    <select id="categorySelect" name="id_category">
        <?php
        // Call the getCategoryNames function to fetch category names
        $categoryNames = getCategoryNames(); // Assuming $conn is your database connection

        // Check if there are category names available
        if (!empty($categoryNames)) {
            // Loop through the category names and generate <option> elements
            foreach ($categoryNames as $categoryName) {
                echo '<option value="' . $categoryName . '">' . $categoryName . '</option>';
            }
        } else {
            echo '<option value="">No categories available</option>';
        }
        ?>
    </select>
                    <label for="categorySelect">entreprise:</label>
                    <select id="categorySelect" name="id_entreprise">
                        <option value="option1">financial </option>
                        <option value="option2">technology</option>
                        <option value="option3">teaching</option>
                    </select>
                    <label for="categorySelect">recruteur:</label>
                    <select id="categorySelect" name="id_recruteur">
                        <option value="option1">financial </option>
                        <option value="option2">technology</option>
                        <option value="option3">teaching</option>
                    </select>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <div class="inner"></div>
                        <input type="submit" value="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

   

    <script type="text/javascript">
        
  function valider() {
    var id = document.getElementsByName("id_job_offers")[0].value;
    var date = document.getElementsByName("date")[0].value;
    var titre = document.getElementsByName("titre")[0].value;
    var lieu = document.getElementsByName("lieu_travail")[0].value;
    var experience = document.getElementsByName("experience")[0].value;
    var description = document.getElementsByName("description")[0].value;
    var competence = document.getElementsByName("competence_requis")[0].value;

    if(id === "") {
      alert("Saisissez l'id_offer");
      return false;
    }
    if(date === "") {
      alert("Saisissez Votre date");
      return false;
    }
    if(titre === "") {
      alert("Saisissez titre");
      return false;
    }
    if(lieu === "") {
      alert("Saisissez le lieu");
      return false;
    }
    if(experience === "") {
      alert("Saisissez niveau");
      return false;
    }
    if(description === "") {
      alert("Saisissez description");
      return false;
    }
    if(competence === "") {
      alert("Saisissez competence");
      return false;
    }

    // If all fields are filled, submit the form
    return true;
  }
</script>


</body>
</html>
