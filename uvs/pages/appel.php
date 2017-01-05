<?php 
    session_start();
    require("connexion.php"); 
    if(isset($_POST['envoyer'])) {
        $dossier = '/var/www/html/uvs/sons/';
        $fichier = basename($_FILES['avatar']['name']);
        $taille_maxi = 1000000;
        $taille = filesize($_FILES['avatar']['tmp_name']);
        $extensions = array('.wav');
        $extension = strrchr($_FILES['avatar']['name'], '.'); 
//Début des vérifications de sécurité...
    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
         $erreur = 'Vous devez uploader un fichier de type wav';
    }
    if($taille>$taille_maxi)
    {
         $erreur = 'Le fichier est trop gros...';
    }
    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
     //On formate le nom du fichier ici...
         $fichier = strtr($fichier, 
              'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
              'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
        if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
            include("connexion.php");
            if(isset($_POST['destinataire']) && isset($_POST['dateCampagne']) && isset($_POST['nomCampagne']) && isset($_POST['heureCampagne']) ){
            
                $req=$bdd->prepare('insert into Appel(destinataire,nomCampagne,dateCampagne,heureCampagne,message) values(:destinataire,:nomCampagne,:dateCampagne,:heureCampagne,:message)');
                $req->execute(array(':destinataire'=>$_POST['destinataire'],':nomCampagne'=>$_POST['nomCampagne'],':dateCampagne'=>$_POST['dateCampagne'],':heureCampagne'=>$_POST['heureCampagne'],':message'=>$fichier)); 
                $req->closeCursor();
                list($h,$mn) = explode(":", $_POST["heureCampagne"]);
                list($a,$m,$j) = explode("-", $_POST["dateCampagne"]);
                //echo exec("echo '$mn $h $j $m * root php-cli -f /var/www/html/uvs/pages/appelPredictif.php' >> /etc/crontab");
                ?>  
                <script type = "text/javascript">
                    res = alert('Bien enregistré');
                </script>
                <?php
            }
            else{
                ?>  
                <script type = "text/javascript">
                    res = alert('Enregistrement échoué');
                </script>
                <?php
            }
        }
        else
        {   
            ?>  
            <script type = "text/javascript">
                    res = alert('Echec de l\'upload !');
            </script>
            <?php
        }
    }
    else
    {
            ?>  
            <script type = "text/javascript">
                    var s = '<?php echo $erreur; ?>'
                    res = alert(s);
            </script>
            <?php
         //echo $erreur;
    }
    }

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UVS: Recherche</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="../img/favicon.png" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <!-- <center ><img src="../img/logo-uvs.png" width="220px" height="120px"></center>-->
            </div>
            <center><img src="../img/banniere1.png"></center>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['nom']; ?></a>
                        </li>
                        <li><a href="profilAssistant.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <a href="http://google.sn" onclick="window.open(this.href); return false;">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button></a>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="accueil.php"><i class="fa fa-dashboard fa-fw"></i> Accueil</a>
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-film"></i> Campagnes <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#"><i class="fa fa-envelope-o"></i> Campagne SMS <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="msgop.php">Par opérateur</a>
                                        </li>
                                        <li>
                                            <a href="msgip.php">Par IP</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="mail.php"><i class="fa fa-google-plus-square"></i> Campagne Mail</a>
                                </li>
                                <li>
                                    <a href="appel.php"><i class="fa fa-mobile-phone"></i> Campagne Appel</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="remonteeDeficheINE.php"><i class="fa fa-mortar-board"></i> Recherche étudiant <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="remonteeDeficheZero.php"><i class="fa fa-edit fa-fw"></i>Par INE</a>
                                </li>
                                <li>
                                    <a href="remonteeDeficheZeroTEL.php"><i class="fa fa-phone"></i> Par numéro Téléphone</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-microphone"></i>&nbsp;Conférence <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#"><i class="fa fa-group"></i> Groupe<span class="fa arrow"></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="CreerGroupe.php">Créer</a>
                                            </li>
                                            <li>
                                                <a href="ModifierGroupe.php">Modifier</a>
                                            </li>
                                            <li>
                                                <a href="SupprimerGroupe.php">Supprimer</a>
                                            </li>
                                        </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-user fa-fw"></i> Utilisateur<span class="fa arrow"></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="CreerUser.php">Créer</a>
                                            </li>
                                            <li>
                                                <a href="ModifierUser.php">Modifier</a>
                                            </li>
                                            <li>
                                                <a href="SupprimerUser.php">Supprimer</a>
                                            </li>
                                        </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-video-camera"></i>  Créer Conférence<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="ListeConference.php">Liste des Conférences</a>
                                            </li>
                                            <li>
                                                <a href="CreerConference.php">Réserver une Conférence</a>
                                            </li>
                                        </ul>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="ListeMoodle.php"><i class="fa fa-book"></i>  Moodle</a>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Campagne Appel</h1>
                            <div class="col-lg-12" align="center">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        Passer un appel
                                    </div>
                                    <div class="panel-body">
                                        <form  action="<?php  echo($_SERVER['PHP_SELF']); ?>" method="POST" id="chgfiliere" enctype="multipart/form-data" > 
                          
                                        <div class="form-group input-group">
                                                <span class="input-group-addon">Destinataire &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <input type="number" name="destinataire"  id='destinataire' class="form-control" required placeholder="exemple 1000">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Nom Campagne </span>
                                            <input type="text" name="nomCampagne" id="nomCampagne"  class="form-control" >
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Date d'Appel &nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <input type="date" name="dateCampagne" id="dateCampagne"  class="form-control" placeholder="année-mois-jour">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Heure d'Appel &nbsp;&nbsp;</span>
                                            <input type="time" name="heureCampagne" id="heureCampagne"  class="form-control" placeholder="heure:mn">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Message &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <input type="file" name="avatar" id="avatar" class="form-control" >
                                        </div>
                                        
                                        </br> 
                                        </br>  
                                        <div align="center">
                                        <button type="submit" name="envoyer" value="envoyer" class="btn btn-outline btn-primary" name="submit" >Appeler</button>
                                        <button type="reset" class="btn btn-outline btn-warning"> Initialiser</button>
                                        </div>                                     
                            </form>
                                    </div>
                                    <div class="panel-footer">
                                        
                                    </div>
                                </div>
                                <!-- /.col-lg-4 -->
                            </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

   

</body>

</html>
