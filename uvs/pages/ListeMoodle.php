<?php
    session_start();
    require("connexion.php"); 
    $profile  = isset($_SESSION['name']) ? $_SESSION['name']:'User';
    $idr = isset($_POST['eno'])?$_POST['eno']:null;
    try{
        $bdd1 = new PDO ('mysql:host=localhost;dbname=moodledb;charset=utf8', 'mdluser','passer');
        }
    catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
        } 
    $req2=$bdd1->prepare("SELECT * FROM mdl_user where username != :log");
    $req2->execute(array("log"=>'guest'));

    function DateDiff($timestamp)
    {
        $difference = time()-$timestamp;
        $jour = floor($difference/86400); 
        // le % signifie modulo qui permet de récuperer le reste d'une division
        $reste = ($difference%86400);
        $heure = floor($reste/3600);
        $reste = ($difference%3600);
        $minute = floor($reste/60);
        return $jour.' jour(s), '.$heure.' heure(s) et '.$minute.' minute(s)';
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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $profile; ?></a>
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
                            <a href="#"><i class="fa fa-mortar-board"></i> Recherche étudiant <span class="fa arrow"></span></a>
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
                                    <a href="#"><i class="fa fa-video-camera"></i>  Créer Conférence<span class="fa arrow"></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="ListeConference.php">Liste des Conférences</a>
                                            </li>
                                            <li>
                                                <a href="CreerConference.php">Réserver une conférence</a>
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
                        <h1 class="page-header">La liste des Conférences</h1>
                    </div>
                       
                    <div class="panel-body">
                                        
                                    </div>

                                    <div class="row">

                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           La liste des Conférences
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Prénom</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Dernier Accés</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; while($reponse=$req2->fetch()){
                                                    ?>  
                                        <tr>                                                        
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo ($reponse["firstname"]); ?></td>
                                            <td><?php echo ($reponse["lastname"]); ?></td>
                                            <td><?php echo ($reponse["email"]); ?></td>
                                            <td><?php if($reponse["lastaccess"]==0) echo '<font color="red"> Jamais </font>'    ; 
                                                    else{
                                                        $difference = time()-$reponse["lastaccess"];
                                                        $jour = floor($difference/86400); 
                                                        $reste = ($difference%86400);
                                                        $heure = floor($reste/3600);
                                                        $reste = ($difference%3600);
                                                        $minute = floor($reste/60);
                                                        if($jour >= 1)
                                                            echo '<font color="red">'.$jour.' jours '.$heure.' heure(s) '.$minute.' minute(s)</font>'; 
                                                        else 
                                                            echo $jour.' jour(s) '.$heure.' heure(s) '.$minute.' minute(s)';

                                            } ?></td>
                                        </tr>
                                        <?php $i = $i + 1;} ?>
                            
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>



                    </div>        <!-- /.col-lg-4 -->
                </div>
            </div>
                    <!-- /.col-lg-12 -->
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
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
   

</body>

</html>
