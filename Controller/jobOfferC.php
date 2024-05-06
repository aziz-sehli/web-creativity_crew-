<?php

require_once 'C:/xampp/htdocs/dist/config.php';
require_once 'C:/xampp/htdocs/dist/Model/job.php';
require_once 'C:/xampp/htdocs/dist/Model/category.php';
class jobOfferC {
	function addJobOffer($jobOffer){
		 $sql="INSERT INTO job_offers (id_job_offers, id_entreprise, id_recruteur, id_category, date, titre, description, competence_requis, experience, lieu_travail) 
		 VALUES (:id_job_offers, :id_entreprise, :id_recruteur, :id_category, :date, :titre, :description, :competence_requis, :experience, :lieu_travail)";
		 $db = new config();
		 $conn=$db->getConnexion();
		 try{
			 $query = $conn->prepare($sql);
			 $query->execute([
				'id_job_offers' => $jobOffer->getid_job_offers(),
				'id_entreprise' => $jobOffer->getid_entreprise(),
				'id_recruteur' => $jobOffer->getid_recruteur(),
				'id_category' => $jobOffer->getid_category(),
				'date' => $jobOffer->getdate(),
				'titre' => $jobOffer->gettitre(),
				'description' => $jobOffer->getdescription(),
				'competence_requis' => $jobOffer->getcompetence_requis(),
				'experience' => $jobOffer->getexperience(),
				
				'lieu_travail' => $jobOffer->getlieu_travail()
			]);			
		}
		catch (Exception $e){
			echo 'Error: '.$e->getMessage();
		}
	}
	
	function getAllJobOffers(){
		$sql="SELECT * FROM job_offers";
		$conn = new config();
		$db=$conn->getConnexion();
		try{
			$liste = $db->query($sql);
			return $liste;
		}
		catch (Exception $e){
			die('Error: '.$e->getMessage());
		}	
		
	}

	function deleteJobOffer($idJobOffer){
		$sql="DELETE FROM job_offers WHERE id_job_offers = :id_job_offers";
		$conn = new config();
		$db=$conn->getConnexion();
		$req=$db->prepare($sql);
		$req->bindValue(':id_job_offers', $idJobOffer);
		try{
			$req->execute();
		}
		catch (Exception $e){
			die('Error: '.$e->getMessage());
		}
	}

	function updateJobOffer($jobOffer, $idJobOffer){
    try {
        $conn = new config();
        $db = $conn->getConnexion();
        $query = $db->prepare(
            "UPDATE job_offers SET 
                id_entreprise = :id_entreprise,
                id_recruteur = :id_recruteur,
                id_category = :id_category,
                date = :date,
                titre = :titre,
                description = :description,
                competence_requis = :competence_requis,
                experience = :experience,
                lieu_travail = :lieu_travail
            WHERE id_job_offers = :id_job_offers"
        );
        $query->execute([
            'id_entreprise' => $jobOffer->getid_entreprise(),
            'id_recruteur' => $jobOffer->getid_recruteur(),
            'id_category' => $jobOffer->getid_category(),
            'date' => $jobOffer->getdate(),
            'titre' => $jobOffer->gettitre(),
            'description' => $jobOffer->getdescription(),
            'competence_requis' => $jobOffer->getcompetence_requis(),
            'experience' => $jobOffer->getexperience(),
            'lieu_travail' => $jobOffer->getlieu_travail(),
            'id_job_offers' => $idJobOffer
        ]);
        echo $query->rowCount() . " records updated successfully <br>";
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
		var_dump($query->errorInfo());
    }
}

	function getJobOffer($idJobOffer){
		$sql="SELECT * from job_offers where id_job_offers = $idJobOffer";
		$conn = new config();
		$db=$conn->getConnexion();
		try{
			$query=$db->prepare($sql);
			$query->bindParam(':id_job_offers', $idJobOffer, PDO::PARAM_STR);
			
			$query->execute();

			$jobOffer=$query->fetch();
			return $jobOffer;
		}
		catch (Exception $e){
			die('Error: '.$e->getMessage());
		}
	}

	function getJobOfferbycategory($category_name){
    $sql = "SELECT * FROM job_offers WHERE id_category = :id_category";
    $conn = new config();
    $db = $conn->getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':id_category', $category_name, PDO::PARAM_STR);
        $query->execute();
        // Fetch all rows (as you're expecting multiple job offers for a category)
        $jobOffers = $query->fetchAll(PDO::FETCH_ASSOC);
        return $jobOffers;
    } catch (Exception $e) {
        die('Error: '.$e->getMessage());
    }
}


   

function getCategoryNames() {
    // Query to retrieve only category names
    $sql = "SELECT category_name FROM categorys";

    $conn = new config();
    $db = $conn->getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute();

        // Initialize the array to store category names
        $categoryNames = [];

        // Fetch category names
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            // Add category name to the array
            $categoryNames[] = $row['category_name'];
        }

        // Return the array of category names
        return $categoryNames;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
function rechercherjoboffer($searchQuery){
	$sql = "SELECT * FROM job_offers WHERE id_job_offers LIKE :searchQuery OR date LIKE :searchQuery OR titre LIKE :searchQuery OR lieu_travail LIKE :searchQuery";
	$conn = new config();
	$db = $conn->getConnexion();
	
	try {
		$query = $db->prepare($sql);
		$searchQuery = "%$searchQuery%"; // Add wildcards for a partial match
		$query->bindParam(':searchQuery', $searchQuery);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	} catch (Exception $e) {
		die('Erreur: '.$e->getMessage());
	}
}



function generateCategoryStatistic()
{
    // Create the database connection
    $conn = new config();
    $db = $conn->getConnexion();

    // Query to count occurrences of each category
    $sql = "SELECT id_category, COUNT(*) AS category_count FROM job_offers GROUP BY id_category ORDER BY category_count DESC";

    try {
        $query = $db->prepare($sql);
        $query->execute();
        $categoryStats = $query->fetchAll(PDO::FETCH_ASSOC);

        // Calculate total number of job offers
        $totalJobOffers = array_sum(array_column($categoryStats, 'category_count'));

        // Generate data for the chart
        $labels = [];
        $data = [];
        foreach ($categoryStats as $category) {
            $labels[] = $category['id_category'];
            $percentage = ($category['category_count'] / $totalJobOffers) * 100;
            $data[] = round($percentage, 2); // Round to 2 decimal places
        }

       // Generate the chart
	   echo "<div style='display: flex; justify-content: center;'>"; // Centering container
	   echo "<h2>Category Statistics</h2>";
	   echo "<div>";
	   echo "<canvas id='categoryChart' width='600' height='400'></canvas>";
	   echo "</div>";
	   echo "</div>";
	   
	   // JavaScript to initialize Chart.js and create the chart
	   echo "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";
	   echo "<script>
			   var ctx = document.getElementById('categoryChart').getContext('2d');
			   var myChart = new Chart(ctx, {
				   type: 'bar',
				   data: {
					   labels: " . json_encode($labels) . ",
					   datasets: [{
						   label: 'Percentage of Job Offers',
						   data: " . json_encode($data) . ",
						   backgroundColor: 'rgba(255, 99, 132, 0.6)', // Adjust bar color
						   borderColor: 'rgba(255, 99, 132, 1)', // Adjust bar border color
						   borderWidth: 1
					   }]
				   },
				   options: {
					   scales: {
						   y: {
							   beginAtZero: true,
							   title: {
								   display: true,
								   text: 'Percentage'
							   }
						   },
						   x: {
							   title: {
								   display: true,
								   text: 'Category'
							   }
						   }
					   },
					   // Set the width and height of the chart
					   responsive: false, // Disable responsiveness
					   maintainAspectRatio: false, // Disable aspect ratio
					   width: 600, // Set the width
					   height: 400 // Set the height
				   }
			   });
		   </script>";
	   


    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
        exit;
    }
}
}
?>
