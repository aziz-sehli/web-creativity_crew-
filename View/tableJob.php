<?php
   require_once 'C:/xampp/htdocs/dist/Controller/jobOfferC.php';
   
    $jobOfferC = new jobOfferC();
    $jobOffersList = $jobOfferC->getAllJobOffers();

    if (isset($_POST['submit'])) {
        $jobOffersList = $jobOfferC->getAllJobOffers();
    }

    
?>
<!doctype html>
<html lang="en">

<head>
    <title>Liste des offres d'emploi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        :root {
    --primary: #EB1616;     /* Primary color */
    --secondary: #191C24;   /* Secondary color */
    --light: #6C7293;       /* Light color */
    --dark: #000000;        /* Dark color */
}

/* Body */
body {
    background-color: var(--secondary); /* Background color */
    color: var(--light);                 /* Text color */
}

/* Buttons */
button {
    background-color: var(--primary); /* Button background color */
    color: var(--secondary);           /* Button text color */
    border: none;
    padding: 5px 10px;
    cursor: pointer;
}

button:hover {
    background-color: var(--dark);    /* Button hover background color */
}

/* Table */
.container-fluid.pt-4.px-4 {
    background-color: var(--secondary); /* Background color */
    color: var(--light);                 /* Text color */
}

.table th,
.table td {
    color: var(--light); /* Text color */
}

/* Table Header */
.table thead th {
    color: var(--primary); /* Header text color */
}

/* Table Body */
.table tbody th,
.table tbody td {
    color: var(--light); /* Body text color */
}

/* Navbar */
.content .navbar .navbar-nav .nav-link {
    margin-left: 25px;
    padding: 12px 0;
    color: var(--light);
    outline: none;
}

.content .navbar .navbar-nav .nav-link:hover,
.content .navbar .navbar-nav .nav-link.active {
    color: var(--primary);
}

/* Sidebar */
.sidebar {
    background: var(--secondary);
}

.sidebar .navbar .navbar-nav .nav-link {
    color: var(--light);
    border-left: 3px solid var(--secondary);
}

.sidebar .navbar .navbar-nav .nav-link:hover,
.sidebar .navbar .navbar-nav .nav-link.active {
    color: var(--primary);
    background: var(--dark);
    border-color: var(--primary);
}

/* Dropdown */
.sidebar .navbar .dropdown-item {
    color: var(--light);
}

.sidebar .navbar .dropdown-item:hover,
.sidebar .navbar .dropdown-item.active {
    background: var(--dark);
}
    </style>
</head>

<body>
    
    <section class="background-image">
        <div class="container">
            <h3 class="text">Affichage des offres d'emploi</h3>
            <br>
            <br>
            
            <table>
                <thead>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Compétences Requises</th>
                    <th>Expérience</th>
                    <th>Lieu de Travail</th>
                    <th>ID Entreprise</th>
                    <th>ID Recruteur</th>
                    <th>ID Catégorie</th>
                    <th>Date</th>
                </thead>
                <tbody>
                    <?php foreach ($jobOffersList as $jobOffer) { ?>
                        <tr>
                            <td><?php echo $jobOffer['id_job_offers']; ?></td>
                            <td><?php echo $jobOffer['titre']; ?></td>
                            <td><?php echo $jobOffer['description']; ?></td>
                            <td><?php echo $jobOffer['competence_requis']; ?></td>
                            <td><?php echo $jobOffer['experience']; ?></td>
                            <td><?php echo $jobOffer['lieu_travail']; ?></td>
                            <td><?php echo $jobOffer['id_entreprise']; ?></td>
                            <td><?php echo $jobOffer['id_recruteur']; ?></td>
                            <td><?php echo $jobOffer['id_category']; ?></td>
                            <td><?php echo $jobOffer['date']; ?></td>
                            <td>
                            <td>
                                <form method="POST" action="modify.php" onsubmit="return confirm('Are you sure you want to modify this job offer?')">
                                    <input type= "hidden" name="id_job_offers" value="<?php echo $jobOffer['id_job-offers']; ?>">
                                     <button type="submit">update</button>
                                </form>
                            </td>
                            <td>
    <form method="POST" action="delete.php" onsubmit="return confirm('Are you sure you want to delete this job offer?')">
        <input type="hidden" name="id_job_offers" value="<?php echo $jobOffer['id_job_offers']; ?>">
        <button type="submit">delete</button>
    </form>
</td>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </section>
    <script>
        function deleteJobOffer(id) {
            if (confirm('Are you sure you want to delete this job offer?')) {
                // Create a form element
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'delete.php';

                // Create an input field to hold the ID
                var inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = 'id_job_offers';
                inputId.value = id;

                // Append the input field to the form
                form.appendChild(inputId);

                // Append the form to the document body and submit it
                document.body.appendChild(form);
                form.submit();
            }
        }
        
        
function modifyJobOffer(id) {
    // Create a form element
    var form = document.createElement('form');
    form.method = 'GET'; // Change the method to GET
    form.action = 'modify.php'; // Change the action to the modify.php page

    // Create an input field to hold the ID
    var inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = 'id_job_offers'; // Change the name to match the parameter in modify.php
    inputId.value = id;

    // Append the input field to the form
    form.appendChild(inputId);

    // Append the form to the document body and submit it
    document.body.appendChild(form);
    form.submit();
}
    </script>
</body>

</html>
