<?php
require_once 'C:/xampp/htdocs/dist/Controller/jobOfferC.php';

$jobOfferC = new jobOfferC();
$categoryChart = $jobOfferC->generateCategoryStatistic(); // Call the method using the object

$jobOffersList = $jobOfferC->getAllJobOffers();

if (isset($_POST['submit'])) {
    $jobOffersList = $jobOfferC->getAllJobOffers();
}
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des offres d'emploi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 20px;
        }

        .chart-container {
    max-width: 800px; /* Adjust the maximum width as needed */
    margin: 0 auto;
    padding: 20px;
    background-color: #f0f0f0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    margin-bottom: 20px; /* Add margin-bottom to create space between the chart and the job list */
}

.chart-container h3 {
    color: #333;
    margin-top: 0;
    margin-bottom: 10px; /* Add margin-bottom to create space between the chart title and the chart */
}

        .job-list-container h3 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        form {
            display: inline-block;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 3px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <section class="chart-container">
        <!-- Container for the chart -->
        <div class="container">
            <h3 class="text">Affichage des offres d'emploi</h3>
            <!-- Echo the variable containing the chart -->
            <?php echo $categoryChart; ?>
        </div>
    </section>

    <section class="job-list-container">
        <!-- Container for the job list -->
        <div class="container">
            <h3>Liste des offres d'emploi</h3>
            <table>
                <!-- Table content here -->
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
                                <form method="POST" action="modify.php" onsubmit="return confirm('Are you sure you want to modify this job offer?')">
                                    <input type="hidden" name="id_job_offers" value="<?php echo $jobOffer['id_job_offers']; ?>">
                                    <button type="submit">update</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="delete.php" onsubmit="return confirm('Are you sure you want to delete this job offer?')">
                                    <input type="hidden" name="id_job_offers" value="<?php echo $jobOffer['id_job_offers']; ?>">
                                    <button type="submit">delete</button>
                                </form>
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