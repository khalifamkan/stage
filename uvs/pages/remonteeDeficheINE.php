<?php 

include('connexion.php');
  session_start();
    $ine=$_POST['ine'];
    $req=$bdd->prepare("SELECT * FROM Etudiant  where INE=:log");
    $req->execute(array("log"=>$_POST['ine']));
    if($reponse=$req->fetch())
     {  
        $numTel=$reponse["numeroTel"];
        $nom=$reponse["nomEtudiant"];
        $prenom=$reponse["prenomEtudiant"];
        $filiere=$reponse["filiere"];
        $num=$reponse["numeroTel"];
        $demande=$reponse["demande"];
        $chemin = "Location:remontee.php?num=".$numTel;
        if (isset($numTel)) {
            header($chemin);
            exit();
        } 
        else {
            echo "INE n'existe pas";
             }     
    }
        ?>  
            <script type = "text/javascript">
                res = alert('Enregistrement échoué');
            </script>
        <?php
        header("Location:remonteeDeficheZero.php");
        exit();

?>

