<?php 
require ("connexion.php");


session_start();


	$req=$bdd->prepare("UPDATE Demande SET nomDemande = :nom,EtatDemande = :etat,DateDemande = :dateD,lib = :lib WHERE idDemande =:id");
	$req->execute(array( "nom"=>$_POST["nomDemande"],"etat"=>$_POST["etat"],"dateD"=>$_POST["DateDemande"],"lib"=>$_POST["lib"],"id"=>$_POST["id"]));

$chemin = "location:remontee.php?num=".$_POST['numero'];
if($req){
	?><script type = "text/javascript">
       	res = alert('Etat de la demande modifiee');
     </script><?php
	header($chemin);
	exit();
}
$req->closeCursor();
?>