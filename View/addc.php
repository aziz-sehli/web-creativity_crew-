<?php
    require_once 'C:/xampp/htdocs/dist/Controller/categoryc.php';
    require_once 'C:/xampp/htdocs/dist/Model/category.php';

    $error = "";
    // create job offer
    $category = null;
    // create an instance of the controller
    $categoryc= new categoryc();
    if (
        isset($_POST["category_id"]) &&
        isset($_POST["category_name"]) &&
        isset($_POST["category_des"]) 
       
       ) 
    {
        if (
            !empty($_POST["category_id"]) && 
            !empty($_POST["category_name"]) && 
            !empty($_POST["category_des"]) 
            
        ) {
            $category = new category(
                $_POST['category_id'], 
                $_POST['category_name'],
                $_POST['category_des']
                
            );
            $categoryc->addcategory($category);
            header('Location:../View/admin.php');
        }
        else
            $error = "Missing information";
    }  
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Crud</title>
    <link rel="stylesheet" href="./styleadmin.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet"/>
    <style>
        .main-content {
            margin-left: 250px; /* Adjust this value to push the form more to the right */
            padding: 20px;
        }
    </style>
</head>
<body>
<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>category</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="logo.JPG" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">feres</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <div class="nav-item dropdown">
            </div>
            <a href="admin.php" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>category</a>
            <!-- Wrap the "add category" link in a div -->
            <div class="nav-item">
                <a href="addc.php" class="nav-link"><i class="fa fa-table me-2"></i>add category</a>
            </div>
            <div class="nav-item">
                <a href="tableJob.php" class="nav-link"><i class="fa fa-table me-2"></i>display job offers</a>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->

<!-- Main Content Start -->
<div class="main-content">
    <form method="POST">
        <h1>Add Category</h1>
        <div class="separation"></div>
        <div class="corps-formulaire">
            <div class="gauche">
                <div class="groupe">
                    <label for="category_id">ID category</label>
                    <input type="text" autocomplete="off" id="category_id" name="category_id"/>
                </div>
                <div class="groupe">
                    <label for="category_name">Category Name</label>
                    <textarea autocomplete="off" id="category_name" placeholder="Category name" name="category_name"></textarea>
                </div>
                <div class="groupe">
                    <label for="category_des">Category Description</label>
                    <textarea autocomplete="off" id="category_des" placeholder="Category description" name="category_des"></textarea>
                </div>
                <div class="gauche">
                    <div class="pied-formulaire" align="center">
                        <button type="submit">Add Category</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Main Content End -->

</body>
</html>