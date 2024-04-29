<?php
   require_once 'C:/xampp/htdocs/dist/Controller/categoryc.php';
   
    $categoryc = new categoryC();
    $listecategory = $categoryc->getAllcategorys();

    if (isset($_POST['submit'])) {
        $listecategory = $categoryc->getAllcategorys();
    }

    if(isset($_POST['add']))
{
    header ('Location:../View/addc.php');
}
?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Liste des category</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="styleadmin" href="styleadmin.css">

	</head>

	<body>
	<section class="ftco-section">
		<div class="container">
            <h3 class="mb-4 text-center"><FONT COLOR="white"><strong>Affichage des category</strong></FONT></h3>
            <br>
            <br>
            <div class="form-group">
                <a href="../View/addc.php">
                    <button type="add" name="actualiser" value="add" class="btn btn-primary">
                       ajouter une category
                    </button>
                </a>
                <a href="template/reclamation.html">
                    <button type="ajout" name="actualiser" value="Ajouter" class="btn btn-primary">
                        HOME 
                    </button>
                </a>
            </div>
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
                                <button type="button" onclick="deletecategory(<?php echo $category['category_id']; ?>)">Delete</button>
                            </td>
                            <td>
                              <div class="form-group">
                              <button type="button" onclick="updatecategory(<?php echo $category['category_id'];?>)">update</button>
               </div>
             </td>
            </td>
                        
                    </tr>
                    <?PHP
				        }
			        ?>
                </tbody>
            </table>
            
		</div>
	</section>


	<script src="js/jquery.min.js"></script>
  	<script src="js/popper.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/jquery.validate.min.js"></script>
  	<script src="js/main.js"></script>
      <script>
        function deletecategory(id) {
            if (confirm('Are you sure you want to delete this job offer?')) {
                // Create a form element
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'deletec.php';

                // Create an input field to hold the ID
                var inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = 'category_id';
                inputId.value = id;

                // Append the input field to the form
                form.appendChild(inputId);

                // Append the form to the document body and submit it
                document.body.appendChild(form);
                form.submit();
            }
        }
        
        
function updatecategory(id) {
    // Create a form element
    var form = document.createElement('form');
    form.method = 'GET'; // Change the method to GET
    form.action = 'modifyc.php'; // Change the action to the modify.php page

    // Create an input field to hold the ID
    var inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = 'category_id'; // Change the name to match the parameter in modify.php
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