<?PHP
	include "../Controller/reponseC.php";

	$reponseC=new reponseC();
	
	if (isset($_POST["id"])){
		$reponseC->supprimerReponse($_POST["id"]);
		header ('Location:../View/tableReponse.php');
	}
?>