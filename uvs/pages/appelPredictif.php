<?php 
   	session_start();
	$date = date("Y-m-d");
	$heure = date("H:i");
	echo "string";
	require 'connexion.php';
    $requ1 = $bdd->prepare('SELECT * FROM Appel WHERE dateCampagne = ?');
    $requ1->execute(array($date));
    while($reponse=$requ1->fetch())
     {
     	list($h,$mn) = explode(":", $reponse["heureCampagne"]);
     	$HM = $h.":".$mn;
    	if($HM==$heure){
     		$numero = $reponse["destinataire"];
		    $idAppel = $reponse["idAppel"];
    		echo exec("cd /var/www/html/uvs/pages/ && python appel.py $numero $idAppel");
            echo "Appel en cours";
     	}
    	else{
    		echo "faux";
    		echo $reponse["dateCampagne"];
    		echo $reponse["heureCampagne"]; 
    		} 
    		
    } 

?>
