<?php  
        session_start();
        include("connexion.php");
        $chemin = "location:remontee.php?num=".$_POST['numero'];
    if(isset($_POST['nomDemande']) && isset($_POST['DateDemande']) && isset($_POST['etat']) && isset($_POST['lib']) && isset($_POST['ine'])){
        $nomDemande=$_POST['nomDemande'];
        $DateDemande=$_POST['DateDemande'];
        $etat=$_POST['etat'];
        $lib=$_POST['lib'];
        $ine=$_POST['ine'];
       
        $req=$bdd->prepare('insert into Demande(INE,nomDemande,EtatDemande,DateDemande,lib) values(:ine,:nomDemande,:etat,:DateDemande,:lib)');
        $req->execute(array( ':ine'=>$_SESSION['ine'],':nomDemande'=>$_POST['nomDemande'],':etat'=>$_POST['etat'],':DateDemande'=>$_POST['DateDemande'],':lib'=>$_POST['lib'] )); 
        $req->closeCursor();
        ?>  <script type = "text/javascript">
                res = alert"Demande enregistrée avec succés");
            </script><?php
            header($chemin);
        }
    else{
        ?>  <script type = "text/javascript">
                res = alert"Enregistrement échoué");
            </script><?php
            header($chemin);
        }
?>