<?PHP
	 require_once 'C:/xampp/htdocs/dist/Controller/jobOfferC.php';

	$jobOfferC = new jobOfferC();
	
	if (isset($_POST["id_job_offers"])){
        $deleted =$jobOfferC->deleteJobOffer($_POST["id_job_offers"]);
        
        
            if($deleted) {
                // Job offer deleted successfully
                echo "Failed to delete job offer.";
            } else {
                // Failed to delete job offer
                
                echo "<script>window.location.href = 'tableJob.php';</script>";
            }
        } else {
            // ID not provided or invalid
            echo "Invalid request.";
        }
        ?>
