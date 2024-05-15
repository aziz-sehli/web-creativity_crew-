<?php
include_once("../Controller/reclamationC.php");

// Fonction pour récupérer les suggestions depuis la base de données
function getSuggestionsFromDatabase() {
    // Utilisez la classe config pour obtenir une connexion à la base de données
    $conn = new config();
    $pdo = $conn->getConnexion();
    
    // Préparez et exécutez la requête SQL pour récupérer les suggestions
    $statement = $pdo->prepare('SELECT DISTINCT name, mail, type, message FROM reclamation');
    $statement->execute();
    
    // Récupérez les résultats de la requête
    $suggestions = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    // Retournez les suggestions
    return $suggestions;
}

// Check if the search form has been submitted
if(isset($_POST['search'])){
    // Get the search query from the form
    $searchQuery = $_POST['searchQuery'];
    
    // Create an instance of the controller
    $controller = new reclamationC();
    
    // Call the search function and get the results
    $results = $controller->rechercherReclamation($searchQuery);
}

// Get suggestions from the database
$suggestions = getSuggestionsFromDatabase();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Reclamation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #C0DFEF; /* Change background color to green */
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff; /* Change background color to white */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px; /* Adjust margin-top to create space from top */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-container {
            position: relative;
            text-align: center; /* Center the search bar */
        }

        .search-bar {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            outline: none;
            font-size: 16px;
            transition: width 0.3s ease-in-out;
        }

        .search-bar:focus {
            width: 400px;
        }

        .search-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .search-button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Styles for autocomplete */
        #searchResults {
            position: absolute;
            width: 100%;
            background-color: #f9f9f9;
            z-index: 99;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 10px 10px;
        }

        #searchResults div {
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        #searchResults div:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Search Reclamation</h1>
        <div class="search-container">
            <form action="" method="POST">
                <input type="text" id="searchQuery" name="searchQuery" class="search-bar" placeholder="Search..." list="suggestions">
                <div id="searchResults"></div>
                <!-- Afficher les suggestions -->
                <datalist id="suggestions">
                    <?php foreach ($suggestions as $suggestion): ?>
                        <option value="<?php echo $suggestion['name']; ?>">
                        <option value="<?php echo $suggestion['mail']; ?>">
                        <option value="<?php echo $suggestion['type']; ?>">
                        <option value="<?php echo $suggestion['message']; ?>">
                    <?php endforeach; ?>
                </datalist>
                <!-- Fin de l'affichage des suggestions -->
                <button type="submit" name="search" class="search-button">Search</button>
            </form>
        </div>

        <!-- Afficher les résultats de la recherche -->
        <?php if(isset($results) && !empty($results)): ?>
            <h2>Search Results</h2>
            <table id="searchResultsTable">
                <thead>
                    <!-- En-tête du tableau -->
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Message</th>
                        <th>ID Reclamation</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Corps du tableau -->
                    <?php foreach ($results as $result): ?>
                        <tr class="result-row">
                            <td><?php echo $result['id']; ?></td>
                            <td><?php echo $result['name']; ?></td>
                            <td><?php echo $result['mail']; ?></td>
                            <td><?php echo $result['type']; ?></td>
                            <td><?php echo $result['message']; ?></td>
                            <td><?php echo $result['idRec']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif(isset($results) && empty($results)): ?>
            <p>No results found.</p>
        <?php endif; ?>
        <!-- Fin de l'affichage des résultats de la recherche -->
    </div>

    <script>
        // JavaScript for autocomplete functionality
        const searchQuery = document.getElementById('searchQuery');
        const searchResults = document.getElementById('searchResults');
        const suggestions = <?php echo json_encode($suggestions); ?>; // Récupérez la liste des suggestions depuis PHP

        searchQuery.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            const matchedSuggestions = suggestions.filter(suggestion => suggestion.toLowerCase().includes(query));
            displaySuggestions(matchedSuggestions);
        });

        function displaySuggestions(suggestions) {
            let html = '';
            suggestions.forEach(suggestion => {
                html += `<div class="search-dropdown-item">${suggestion}</div>`;
            });
            searchResults.innerHTML = html;
            searchResults.style.display = suggestions.length > 0 ? 'block' : 'none';
        }

        // Gérer la sélection d'un élément dans la liste déroulante
        searchResults.addEventListener('click', function(e) {
            if (e.target.classList.contains('search-dropdown-item')) {
                searchQuery.value = e.target.textContent;
                searchResults.style.display = 'none';
            }
        });

        // Masquer la liste déroulante lors de la soumission du formulaire
        document.querySelector('form').addEventListener('submit', function() {
            searchResults.style.display = 'none';
        });

        // Afficher les détails lorsque vous cliquez sur une ligne de résultat
        document.querySelectorAll('.result-row').forEach(row => {
            row.addEventListener('click', function() {
                // Supprimer la classe active de toutes les lignes
                document.querySelectorAll('.result-row').forEach(row => {
                    row.classList.remove('active');
                });
                // Ajouter la classe active à la ligne cliquée
                this.classList.add('active');
            });
        });
    </script>

