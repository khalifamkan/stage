<?php 

    
    session_start();
    require("connexion.php"); 
    $idr = isset($_POST['eno'])?$_POST['eno']:null;
    $date = date("Y-m-d");
    $heure = date("H:i");

    if(isset($_POST['eno']) && isset($_POST['filiere']) && isset($_POST['envoyer'])) {
        $requ = $bdd->prepare('SELECT numeroTel FROM  Etudiant where ENO=:log1 and filiere=:log2 ');
        $requ->execute(array("log1"=>$_POST['eno'],"log2"=>$_POST['filiere']));
        while($reponse=$requ->fetch()){
                $dest=$reponse['numeroTel'];
                $msg = "'".$_POST['message']."'";
                $req=$bdd->prepare('insert into CampagneSMS(destinataire,message) values(:destinataire');
                $req->execute(array(':destinataire'=>$dest,':message'=>$_POST['message'])); 
                $req->closeCursor();
                //echo $msg;
                echo exec("cd /var/www/html/uvs/pages/ && python send_message.py $dest $msg");
               
        }
         ?>
                <script type = "text/javascript">
                res = alert('message envoye');
                </script><?php

    }

    elseif(isset($_POST['envoyer'])){        
        $dest = $_POST['destinataire'];
        $msg = "'".$_POST['message']."'";
        if($_POST['eno']=='Aucun'){
            if(isset($_POST['destinataire']) && isset($_POST['message'])){                 
                $req=$bdd->prepare('insert into CampagneSMS(destinataire,message) values(:destinataire,:message');
                $req->execute(array(':destinataire'=>$_POST['destinataire'],':message'=>$_POST['message'])); 
                $req->closeCursor();
                echo exec("cd /var/www/html/uvs/pages/ && python send_message.py $dest $msg");
                ?>
                <script type = "text/javascript">
                res = alert('message envoye');
                </script><?php
       
            } 
            else{
                ?>
                <script type = "text/javascript">
                res = alert('Vérifier les données SVP');
                </script><?php

            }
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

    <title>UVS: Plateforme de socialisation</title>

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
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
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
                        <h1 class="page-header">Campagne SMS ( IP )</h1>
                            <div class="col-lg-12" align="center">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        Envoi de SMS
                                    </div>
                                    <div class="panel-body">
                                        <form action="<?php  echo($_SERVER['PHP_SELF']); ?>" method="POST" id="chgfiliere">
                          
                                        <div class="form-group input-group">
                                                <span class="input-group-addon">Destinataire &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <input type="number" name="destinataire"  id='destinataire' class="form-control">
                                                <select name="eno" id="eno" onchange="document.forms['chgfiliere'].submit();" class="form-control">
                                                    <?php if(isset($_POST['eno'])){
                                                    ?><option><?php echo $_POST['eno']; ?> </option>
                                                    <option>Aucun
                                                    <option>Bignona
                                                    <option>Dakar
                                                    <option>Diourbel
                                                    <option>Guédiawaye
                                                    <option>Kaolack
                                                    <option>Kolda
                                                    <option>Mbao
                                                    <option>Mbour
                                                    <option>Podor
                                                    <option>Saint-louis
                                                    <option>Thies
                                                    <option>Ziguinchor
                                                    <?php  } else{ ?>
                                                    <option>Aucun
                                                    <option>Bignona
                                                    <option>Dakar
                                                    <option>Diourbel
                                                    <option>Guédiawaye
                                                    <option>Kaolack
                                                    <option>Kolda
                                                    <option>Mbao
                                                    <option>Mbour
                                                    <option>Podor
                                                    <option>Saint-louis
                                                    <option>Thies
                                                    <option>Ziguinchor
                                                        <?php } ?>
                                                </select>
                                                <?php
                                                    /* On commence par vérifier si on a envoyé un numéro de région et le cas échéant s'il est différent de -1 */       
                                                if(isset($idr) && $idr != -1 && $idr != 'Aucun')
                                                 {
                                                    if(true)   
                                                    {
                                                    /* Maintenant on peut construire la liste déroulante */
                                                ?>
                                                <select name="filiere" id="filiere" class="form-control">
                                                    <option>Informatique
                                                    <option>Mathématique
                                                    <option>SEG
                                                    <option>SJP
                                                    <option>Anglais
                                                    <option>Sociologie
                                                </select>
                                                 
                                                <?php
                                                 
                                                }
                                                 
                                                 
                                                 
                                                }
                                                 
                                                ?>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Message &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <textarea type="text" name="message" id="message" class="form-control" required> </textarea>
                                        </div>
                                        
                                        </br> 
                                        </br>  
                                        <div align="center">
                                        <button type="submit" name="envoyer" value="envoyer" class="btn btn-outline btn-primary">Envoyer</button>
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
