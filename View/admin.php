<?php
   require_once 'C:/xampp/htdocs/dist/Controller/categoryc.php';
   
    $categoryc = new categoryc();
    $listecategory = $categoryc->getAllcategorys();

    if (isset($_POST['submit'])) {
        $listecategory = $categoryc->getAllcategorys();
    }

    if(isset($_POST['add']))
{
    header ('Location:../View/addc.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="admin/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap stylesheet -->
    <link href="admin/darkpan-1.0.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template stylesheet -->
    <link href="styleadmin.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


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


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Table Start -->
            <form method="POST">
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                            <div class="col-sm-12 col-xl-6">
                                <h6 class="mb-4">Liste des category</h6>
                                <table id="myTable" class="table table-striped" >  
                                    <thead>
                                        <th><FONT COLOR="white">category_id</FONT></th>
                                        <th><FONT COLOR="white">category_name</FONT></th>
                                        <th><FONT COLOR="white">categoty_des</FONT></th>
                                        <th><FONT COLOR="white"></FONT></th>
                                        <th><FONT COLOR="white"></FONT></th>
                                    </thead>
                                    <tbody>
                                        <?PHP
                                            foreach($listecategory as $category){
                                        ?>
                                        <tr>
                                            <td class="align-img">
                                                <FONT COLOR="white"><?PHP echo $category['category_id']; ?></FONT>
                                            </td>
                                            <td class="align-img">
                                                <FONT COLOR="white"><?PHP echo $category['category_name']; ?></FONT>
                                            </td>
                                            <td class="align-img">
                                                <FONT COLOR="white"><?PHP echo $category['category_des']; ?></FONT>
                                            </td>
                                            <td>
                                            <td>
    <form method="POST" action="deletec.php" onsubmit="return confirm('Are you sure you want to delete this job offer?')">
        <input type="hidden" name="category_name" value="<?php echo $category['category_name']; ?>">
        <button type="submit">Delete</button>
    </form>
</td>
<td>
    <form method="POST" action="modifyc.php" onsubmit="return confirm('Are you sure you want to modify this job offer?')">
        <input type="hidden" name="category_name" value="<?php echo $category['category_name']; ?>">
        <button type="submit">update</button>
    </form>
</td>
                                </td>
                                            
                                        </tr>
                                        <?PHP
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </form>
            <!-- Table End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="admin/darkpan-1.0.0/js/main.js"></script>
    </section>


<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/main.js"></script>
  <script>
    function deletecategory(name) {
        if (confirm('Are you sure you want to delete this job offer?')) {
            // Create a form element
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'deletec.php';

            // Create an input field to hold the ID
            var inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'category_name';
            inputId.value = name;

            // Append the input field to the form
            form.appendChild(inputId);

            // Append the form to the document body and submit it
            document.body.appendChild(form);
            form.submit();
        }
    }
    
    
    function updatecategory(name) {
    // Create a form element
    var form = document.createElement('form');
    form.method = 'POST'; // Change the method to POST
    form.action = 'modify.php'; // Change the action to the modify.php page

    // Create an input field to hold the ID
    var inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = 'category_name'; // Change the name to match the parameter in modify.php
    inputId.value = name;

    // Append the input field to the form
    form.appendChild(inputId);

    // Append the form to the document body and submit it
    document.body.appendChild(form);
    form.submit();
}
</script>
</body>

</html>