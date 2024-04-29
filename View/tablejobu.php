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
        * {
            margin: 0;
            padding: 0;
            outline: none;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            position: relative;
        }

        .background-image {
            background-image: url("business-man-filling-out-application-form.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .background-image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(28, 12, 6, 0.858);
        }

        .container {
            max-width: 2000px;
            background: #fff;
            width: 2000px;
            padding: 25px 40px 10px 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .container .text {
            text-align: center;
            font-size: 41px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            background: -webkit-linear-gradient(right, #fc6b28, #d24209, #a93008, #0f0414);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        @media (max-width: 700px) {
            .container .text {
                font-size: 30px;
            }

            .container form {
                padding: 10px 0 0 0;
            }

            .container form .form-row {
                display: block;
            }

            form .form-row .input-data {
                margin: 35px 0!important;
            }

            .submit-btn .input-data {
                width: 40%!important;
            }
        }
        /* Remove default styling (box) around the category selector */
        #categorySelect {
            border: none;
            background: transparent;
            padding: 0;
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
                                <button type="button" >apply</button>
                            </td>
                           
            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </section>
    
</body>

</html>