<?php 
session_start();
require ("connexion.php");
$chemin = "location:remontee.php?num=".$_SESSION['num'];
$idDemande=$_GET["idDemande"];
$req=$bdd->prepare("DELETE  FROM Demande where idDemande = :idDemande");
$req->execute(array( "idDemande" => $idDemande ));
$nb = $req->fetchAll();
$chemin = "location:remontee.php?num=".$_SESSION['num'];
if($req){
	?><script type = "text/javascript">
       	res = alert('La demande a ete bien supprime');
     </script><?php
	header($chemin);
	exit();
}
$req->closeCursor();
?>


