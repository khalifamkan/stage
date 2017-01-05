<?php 
require ("connexion.php");


session_start();
$num0 = $_GET['numero'];
echo $num0 ;
$reponse=$bdd->query("SELECT * FROM Employe  where numero='$num0'");
$donnees=$reponse->fetch();
$destinataire = $donnees['email'];
echo $destinataire;
$idD = $_GET["idDemande"];
echo $idD;
$reponse1=$bdd->query("SELECT * FROM Demande  where idDemande='$idD'");
$donnees1=$reponse1->fetch();
$sujet = $donnees1['nomDemande'];
$message = "Votre demande de".$donnees1['lib']."a ete bien prise en compte";
echo $sujet;
echo $message;

if($_GET["Etat"]==1){
	$etat=0;
	$req=$bdd->prepare("UPDATE Demande SET EtatDemande = :etat WHERE idDemande =:id");
	$req->execute(array( "etat"=>$etat,"id"=>$_GET["idDemande"]));
}
else{
	$etat=1;
	$req=$bdd->prepare("UPDATE Demande SET EtatDemande = :etat WHERE idDemande =:id");
	$req->execute(array( "etat"=>$etat,"id"=>$_GET["idDemande"]));
	mail($destinataire, $sujet, $message);
}
$chemin = "location:remonteeEmploye.php?num=".$_GET['numero'];
if($req){
	?><script type = "text/javascript">
       	res = alert('Etat de la demande modifiee');
     </script><?php
	header($chemin);
	exit();
}
$req->closeCursor();
?>