<?php

require_once 'C:/xampp/htdocs/dist/config.php';
require_once 'C:/xampp/htdocs/dist/Model/category.php';

class categoryc {
	function addcategory($category){
		 $sql="INSERT INTO categorys (category_id, category_name, category_des) 
		 VALUES (:category_id, :category_name, :category_des)";
		 $db = new config();
		 $conn=$db->getConnexion();
		 try{
			 $query = $conn->prepare($sql);
			 $query->execute([
				'category_id' => $category->getcategory_id(),
				'category_name' => $category->getcategory_name(),
				'category_des' => $category->getcategory_des()
				
			]);			
		}
		catch (Exception $e){
			echo 'Error: '.$e->getMessage();
		}
	}
	
	function getAllcategorys(){
		$sql="SELECT * FROM categorys";
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

	function deletecategory($category_name){
		$sql="DELETE FROM categorys WHERE category_name = :category_name";
		$conn = new config();
		$db=$conn->getConnexion();
		$req=$db->prepare($sql);
		$req->bindValue(':category_name', $category_name);
		try{
			$req->execute();
		}
		catch (Exception $e){
			die('Error: '.$e->getMessage());
		}
	}

	function updatecategory($category, $category_name){
		try {
			$conn = new config();
			$db=$conn->getConnexion();
			$query = $db->prepare(
				"UPDATE categorys SET 
					category_id = :category_id,
					category_des = :category_des
					
					WHERE category_name = :category_name"
			);
			$query->execute([
				'category_id' => $category->getcategory_id(),
				'category_des' => $category->getcategory_des(),
				
				'category_name' => $category_name
			]);
			echo $query->rowCount() . " records updated successfully <br>";
		} catch (PDOException $e) {
			echo 'Error: '.$e->getMessage();
		}
	}

	function getcategory($category_name){
		$sql = "SELECT * FROM categorys WHERE category_name = :category_name";
		$conn = new config();
		$db = $conn->getConnexion();
		try{
			$query = $db->prepare($sql);
			$query->bindParam(':category_name', $category_name, PDO::PARAM_STR); // Bind the parameter
			$query->execute();
	
			$category = $query->fetch();
			return $category;
		}
		catch (Exception $e){
			die('Error: '.$e->getMessage());
		}
	}
	

}

?>