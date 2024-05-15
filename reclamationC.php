<?PHP
	
	include_once ("../View/config.php");
	include_once("../Model/reclamation.php");

	class reclamationC {
		function ajouterReclamation($reclamation){
			 $sql="INSERT INTO reclamation (id, name, mail, type, message, idRec) 
			 VALUES (:id,:name, :mail, :type, :message, :idRec)";
			 $db = new config();
             $conn=$db->getConnexion();
			 try{
			 	$query = $conn->prepare($sql);
			 	$query->execute([
				'id' => $reclamation->getID(),
				'name' => $reclamation->getName(),
				'mail' => $reclamation->getMail(),
		 		'type' => $reclamation->getType(),
		 		'message' => $reclamation->getMessage(),
		 		'idRec' => $reclamation->getIDRec()
			]);			
			}
			catch (Exception $e){
			echo 'Erreur: '.$e->getMessage();
			}
		}
		
		function afficherReclamation(){
			$sql="SELECT * FROM reclamation";
			$conn = new config();
            $db=$conn->getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}	
			
		}


        function supprimerReclamation($idd){
			// Convert string ID to integer
			$id = (int)$idd;
			
			$sql = "DELETE FROM reclamation WHERE id= :id";
			$conn = new config();
			$db = $conn->getConnexion();
			$req = $db->prepare($sql);
			$req->bindValue(':id', $id, PDO::PARAM_INT); // Bind as integer
			try {
				$req->execute();
			}
			catch (Exception $e) {
				die('Erreur: ' . $e->getMessage());
			}
		}

			function modifierReclamation($reclamation, $idReclamation){
			
				try {
					
					$conn = new config();
					$db=$conn->getConnexion();
					$query = $db->prepare(
						"UPDATE reclamation SET 
							name = :name,
							mail = :mail,
							type = :type,
							message = :message,
							idRec = :idRec
							WHERE id = :id"
					);
					$query->execute([
						'name' => $reclamation->getName(),
						'mail' => $reclamation->getMail(),
						'type' => $reclamation->getType(),
						'message' => $reclamation->getMessage(),
						'idRec' => $reclamation->getIDRec(),			
						'id' => $idReclamation
					]);
					echo $query->execute;
					echo $query->rowCount() . " records UPDATED successfully <br>";
				} catch (PDOException $e) {
					$e->getMessage();
				}
			}
	
	
			function recupererReclamation($idReclamation){
				$sql="SELECT * from reclamation where id=$idReclamation";
				$conn = new config();
				$db=$conn->getConnexion();
				try{
					$query=$db->prepare($sql);
					$query->execute();
	
					$garage=$query->fetch();
					return $garage;
				}
				catch (Exception $e){
					die('Erreur: '.$e->getMessage());
				}
			}
	
			function rechercherReclamation($searchQuery){
				$sql = "SELECT * FROM reclamation WHERE name LIKE :searchQuery OR mail LIKE :searchQuery OR type LIKE :searchQuery OR message LIKE :searchQuery";
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
			
		}



?>