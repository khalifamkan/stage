<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=stage;charset=utf8', 'root', 'seckseck');
    echo'ok';
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('oijfd : '.$e->getMessage());
}

// Si tout va bien, on peut continuer


?>