<?php 
	try{
        $bdd1 = new PDO ('mysql:host=localhost;dbname=moodledb;charset=utf8', 'mdluser','passer');
        }
    catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
        } 
    $req2=$bdd1->prepare("SELECT * FROM mdl_user where username != :log");
    $req2->execute(array("log"=>'guest'));
    while($reponse=$req2->fetch()){
        $difference = time()-$reponse["lastaccess"];
        $jour = floor($difference/86400); 
        $reste = ($difference%86400);
        $heure = floor($reste/3600);
        $reste = ($difference%3600);
        $minute = floor($reste/60);
        if ($reponse["lastaccess"]==0) {
        	$msg = "Bonjour ".$reponse['firstname']." ".$reponse['lastname']."\n Vous vous êtes jamais connecté sur la plateforme d'apprentissage.";
        	echo $msg;
        	$destinataire=$reponse['email'];
            $sujet = "Alerte";
            $message = $msg;
            $message = wordwrap($message, 70, "\r\n");
            $headers = 'From: UVS0test@gmail.com' . "\r\n" .
            'Reply-To: UVS0test@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($destinataire, $sujet, $message,$headers);
        }
        elseif($jour >= 1){
        	$msg = "Bonjour ".$reponse['firstname']." ".$reponse['lastname']."\n ça fait plus de ".$jour." jours que vous n'êtes pas connecté sur la plateforme d'apprentissage.";
        	$destinataire=$reponse['email'];
            $sujet = "Alerte";
            $message = $msg;
            $message = wordwrap($message, 70, "\r\n");
            $headers = 'From: UVS0test@gmail.com' . "\r\n" .
            'Reply-To: UVS0test@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($destinataire, $sujet, $message,$headers);
        }
    }