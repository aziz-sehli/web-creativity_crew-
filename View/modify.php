






<?php



require_once 'C:/xampp/htdocs/dist/Controller/jobOfferC.php';


$jobOfferC= new jobOfferC();


if (isset($_POST['id_job_offers'])) {
    $id_job_offers = $_POST['id_job_offers'];


    $jobOffer = $jobOfferC->getjobOffer($id_job_offers);

 
    if (!$jobOffer) {
        echo "job offer not found!";
        exit;
    }
} else {
    echo "id_job_offers not provided!";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are present and not empty
    if (
        isset($_POST["id_job_offer"]) &&
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
        // Create a new Job object with the provided data
        $updated_jobOffer = new Job(
            $_POST["id_job_offer"],
            $_POST["id_entreprise"],
            $_POST["id_recruteur"],
            $_POST["id_category"],
            $_POST["date"],
            $_POST["titre"],
            $_POST["description"],
            $_POST["competence_requis"],
            $_POST["experience"],
            $_POST["lieu_travail"]
        );

        // Update the category in the database
        $jobOfferC->updatejoboffer($updated_jobOffer, $id_job_offers);

        // Redirect to the admin page after updating
        header('Location:../View/tablejob.php');
        exit();
    } else {
        // If any required field is empty, set an error message
        $error = "Missing information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>modify Job Offer Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style.css">
</head>


<body>
<div class="background-image">
    <div class="container">
        <div class="text">Job Offer Form</div>
        <form method="post" action="/dist/View/modify.php" enctype="multipart/form-data" onsubmit="return valider()" novalidate>
            <div class="form-row">
                <input type="hidden" name="id_job_offers" value="<?php echo $jobOffer['id_job_offers'] ?? ''; ?>">
                <div class="input-data">
                    <input type="date" required name="date" value="<?php echo $jobOffer['date'] ?? ''; ?>">
                    <div class="underline"></div>
                    <label for="date">Date Limite</label>
                </div>
                <div class="input-data">
                    <input type="text" required name="titre" value="<?php echo $jobOffer['titre'] ?? ''; ?>">
                    <div class="underline"></div>
                    <label for="titre">Titre du Poste</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" required name="lieu_travail" value="<?php echo $jobOffer['lieu_travail'] ?? ''; ?>">
                    <div class="underline"></div>
                    <label for="lieu_travail">Lieu de Travail</label>
                </div>
                <div class="input-data">
                    <input type="text" required name="experience" value="<?php echo $jobOffer['experience'] ?? ''; ?>">
                    <div class="underline"></div>
                    <label for="experience">Niveau d'Expérience Requis</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data textarea">
                    <textarea rows="8" cols="80" required name="description"><?php echo $jobOffer['description'] ?? ''; ?></textarea>
                    <br>
                    <div class="underline"></div>
                    <label for="description">Description de l'Offre</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data textarea">
                    <textarea rows="8" cols="80" required name="competence_requis"><?php echo $jobOffer['competence_requis'] ?? ''; ?></textarea>
                    <br>
                    <div class="underline"></div>
                    <label for="competence_requis">Compétences Requises</label>
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
                <label for="entrepriseSelect">Entreprise:</label>
                <select id="entrepriseSelect" name="id_entreprise">
                    <option value="1">Financial</option>
                    <option value="2">Technology</option>
                    <option value="3">Teaching</option>
                </select>
                <label for="recruteurSelect">Recruteur:</label>
                <select id="recruteurSelect" name="id_recruteur">
                    <option value="1">Financial</option>
                    <option value="2">Technology</option>
                    <option value="3">Teaching</option>
                </select>
            </div>
            <div class="form-row submit-btn">
                <div class="input-data">
                    <div class="inner"></div>
                    <input type="submit" value="update job offer">
                </div>
            </div>
        </form>
    </div>
</div>
    <script type="text/javascript">
  function validerm() {
    
    var date = document.getElementsByName("date")[0].value;
    var titre = document.getElementsByName("titre")[0].value;
    var lieu = document.getElementsByName("lieu_travail")[0].value;
    var experience = document.getElementsByName("experience")[0].value;
    var description = document.getElementsByName("description")[0].value;
    var competence = document.getElementsByName("competence_requis")[0].value;

    
    
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