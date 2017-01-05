<?php 

include('connexion.php');
  //session_start();

  $num0=$_GET['num'];
  $reponse=$bdd->query("SELECT count(*) as num1 FROM Etudiant  where numeroTel='$num0'");
  $donnees=$reponse->fetch();

    if($donnees['num1'] == 0)
      include('remonteeDeficheZero.php');
    else
      include('remonteeDeficheNUM.php');      
?>