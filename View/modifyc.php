<?php

require_once 'C:/xampp/htdocs/dist/Controller/categoryc.php';

// Create an instance of the categoryC class
$categoryc = new categoryC();

// Check if the category name is provided in the POST request
if (isset($_POST['category_name'])) {
    $category_name = $_POST['category_name'];

    // Get the category details based on the category name
    $category = $categoryc->getcategory($category_name);

    // Check if the category details are found
    if (!$category) {
        echo "Category not found!";
        exit;
    }
} else {
    echo "Category name not provided!";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are present and not empty
    if (
        isset($_POST["category_id"]) &&
        isset($_POST["category_des"])
    ) {
        // Create a new category object with the provided data
        $updated_category = new category(
            $_POST["category_id"],
            $category_name, // Keep the original category name
            $_POST["category_des"]
        );

        // Update the category in the database
        $categoryc->updatecategory($updated_category, $category_name);

        // Redirect to the admin page after updating
        header('Location:../View/admin.php');
        exit();
    } else {
        // If any required field is empty, set an error message
        $error = "Missing information";
    }
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Crud</title>
    <link rel="stylesheet" href="styleadmin.css" />
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
            rel="stylesheet"
    />
</head>
<body>

<form method="POST">
    <h1>Modifier DES REPONSES</h1>
    <div class="separation"></div>
    <div class="corps-formulaire">
        <div class="gauche">
            <div class="groupe">
                <label>ID category</label>
                <textarea type="text" autocomplete="off" placeholder="category_id"
                          name="category_id"><?php echo $category['category_id']; ?></textarea>
            </div>
            <div class="groupe">
                <label>category_name</label>
                <textarea type="text" autocomplete="off" placeholder="category_name"
                          name="category_name"><?php echo $category['category_name']; ?></textarea>
            </div>
            <div class="groupe">
                <label>category_des</label>
                <textarea type="text" autocomplete="off" placeholder="category_des"
                          name="category_des"> <?php echo $category['category_des']; ?></textarea>
            </div>
            <div class="gauche">
                <div class="pied-formulaire" align="center" name="submit" min="1" max="500" required>
                    <button>Envoyer modification</button>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
