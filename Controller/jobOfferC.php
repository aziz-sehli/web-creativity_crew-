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
			$db=$conn->getConnexion();
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
		}
	}

	function getJobOffer($idJobOffer){
		$sql="SELECT * from job_offers where id_job_offers = $idJobOffer";
		$conn = new config();
		$db=$conn->getConnexion();
		try{
			$query=$db->prepare($sql);
			$query->execute();

			$jobOffer=$query->fetch();
			return $jobOffer;
		}
		catch (Exception $e){
			die('Error: '.$e->getMessage());
		}
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


?>
