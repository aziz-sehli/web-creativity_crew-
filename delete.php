<?PHP
	include "../Controller/reclamationC.php";
	
	$reclamationC=new reclamationC();
	
	if (isset($_POST["id"])){
		$reclamationC->supprimerReclamation($_POST["id"]);
		header ('Location:../View/tableRec.php');
	}
?>