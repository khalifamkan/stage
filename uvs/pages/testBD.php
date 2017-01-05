<?php
try
	{
			$bdd = new PDO ('mysql:host=localhost;dbname=openfire;charset=utf8', 'root','passer');
	}
	catch (Exception $e)
	{
	        die('Erreur : ' . $e->getMessage());
	} 
$req=$bdd->prepare("SELECT * FROM ofGroupUser  where groupName=:log");
$req->execute(array("log"=>'groupe1'));
while($reponse=$req->fetch()){
	echo $reponse['username'];
	$req1=$bdd->prepare("SELECT * FROM ofUser  where username=:log");
	$req1->execute(array("log"=>'admin'));
	while($reponse1=$req1->fetch())
		echo $reponse1['email'];
}
?>