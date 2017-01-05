<?php
    session_start();
if(isset($_POST['login']) && isset($_POST['password'])){
    $name=$_POST['login'];
    $pass=$_POST['password'];
    require("connexion.php");   
    $requ = $bdd->prepare('SELECT count(*) FROM Assistant WHERE login = ? and password= ?');
    $requ->execute(array($name,$pass));
    $cn = $requ->fetchAll();

    $requ1 = $bdd->prepare('SELECT IdAssistant FROM Assistant WHERE login = ? and password= ?');
    $requ1->execute(array($name,$pass));
    $cn1 = $requ1->fetchAll();
    if($cn[0][0]!=0){
        $_SESSION['nom'] = $_POST['login'];
        $_SESSION['id'] = $cn1[0][0];
        header("location:accueil.php");
   
    }
    else{
        require("index.html");
        require("notif.php");
    }
        
}
else{
        require("index.html");
        require("notif.php");

 } ?>




