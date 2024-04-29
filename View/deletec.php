<?PHP
	 require_once 'C:/xampp/htdocs/dist/Controller/categoryc.php';

	$categoryc = new categoryc();
	
	if (isset($_POST["category_name"])){
        $deleted =$categoryc->deletecategory($_POST["category_name"]);
        
        
            if($deleted) {
                // Job offer deleted successfully
                echo "Failed to delete job offer.";
            } else {
                // Failed to delete job offer
                
                echo "<script>window.location.href = 'admin.php';</script>";
            }
        } else {
            // ID not provided or invalid
            echo "Invalid request.";
        }
        ?>
