






<?php



require_once 'C:/xampp/htdocs/dist/Controller/jobOfferC.php';

// Create an instance of the JobOfferC class
$jobOfferC = new JobOfferC();

// Check if the job offer ID is provided in the URL parameter or session storage
if (isset($_POST['id_job_offers'])) {
    $id_job_offer = $_POST['id_job_offers'];

    // Get the category details based on the category name
    $jobOffer = $jobOfferC->getid_job_offers($id_job_offer);

    // Check if the category details are found
    if (!$category) {
        echo "id not found!";
        exit;
    }
} else {
    echo "id name not provided!";
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
        $jobOffer = new Job(
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

        // Update the job offer in the database
        $jobOfferC->updateJobOffer($jobOffer,$id_job_offer);

        // Redirect to the job table page after updating
        header('Location:../View/tableJob.php');
        exit(); // It's good practice to exit after a redirect
    } else {
        // If any required field is empty, set an error message
        $error = "Missing information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<<head>
    <meta charset="UTF-8">
    <title>modify Job Offer Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style.css">
</head>


<body>
<div class="background-image">
        <div class="container">
    
    <?php if (!empty($error)) echo "<p>Error: $error</p>"; ?> <!-- Display error message -->
    <div class="text">modifyJob Offer Form</div>
    <form method="post"onsubmit="return validerm()"
     novalidate >
        <input type="hidden" name="id_job_offer" value=$id_job_offer>
        <div class="form-row">
                    <div class="input-data">
                        <input type="date" required name="date"value="<?php echo $jobOffer ? $jobOffer['date'] : ''; ?>">
                        <div class="underline"></div>
                        <label for="date">date limite</label>
                    </div>
                    <div class="input-data">
                        <input type="text" required name="titre"value="<?php echo $jobOffer ? $jobOffer['titre'] : ''; ?>">
                        <div class="underline"></div>
                        <label for="titre">titre du poste</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <input type="text" required name="lieu_travail"value="<?php echo $jobOffer ? $jobOffer['lieu_travail'] : ''; ?>">
                        <div class="underline"></div>
                        <label for="lieu_travail">lieu de travail</label>
                    </div>
                    <div class="input-data">
                        <input type="text" required name="experience" value="<?php echo $jobOffer ? $jobOffer['experience'] : ''; ?>">
                        <div class="underline"></div>
                        <label for="experience">niveau d'expérience requis</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data textarea">
                        <textarea rows="8" cols="80" required name="description"><?php echo isset($jobOffer['description']) ? $jobOffer['description'] : ''; ?></textarea>
                        <br>
                        <div class="underline"></div>
                        <label for="description">description de l'offre</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data textarea">
                        <textarea rows="8" cols="80" required name="competence_requis"><?php echo isset($jobOffer['competence_requis']) ? $jobOffer['competence_requis'] : ''; ?></textarea>
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
                    <label for="categorySelect">Entreprise:</label>
                    <select id="categorySelect" name="id_entreprise">
                        <option value="1">Company A</option>
                        <option value="2">Company B</option>
                        <option value="3">Company C</option>
                    </select>
                    <label for="categorySelect">Recruteur:</label>
                    <select id="categorySelect" name="id_recruteur">
                        <option value="1">Recruiter A</option>
                        <option value="2">Recruiter B</option>
                        <option value="3">Recruiter C</option>
                    </select>
                </div>
                
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <div class="inner"></div>
                        <input type="submit" value="Update Job Offer">
                    </div>
    </form>
    </div>
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