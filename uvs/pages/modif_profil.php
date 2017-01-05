<?php 
require ("connexion.php");
$req=$bdd->prepare("UPDATE Etudiant SET email = :email,nomEtudiant = :nom,prenomEtudiant = :prenom,filiere = :filiere,ENO = :ENO,numTel = :numTel  WHERE INE =:id");
$req->execute(array( "email"=>$_POST["email"],"nom"=>$_POST["nom"],"prenom" => $_POST["prenom"],"filiere"=>$_POST["filiere"],"ENO"=>$_POST["ENO"],"numTel" => $_POST["numTel"],"id"=>$_POST["ine"] ));
if($req){
	?><script type = "text/javascript">
       	res = alert('Votre profil a été bien modifié');
     </script><?php
	//header('location:accueil.php');
	exit();
}
$req->closeCursor();
?>