<?php 

include('connexion.php');
    session_start();
    $profile  = isset($_SESSION['name']) ? $_SESSION['name']:'User';
    $req=$bdd->prepare("SELECT * FROM Etudiant  where numeroTel=:log");
    $req->execute(array("log"=>$_GET['num']));
    if($reponse=$req->fetch())
     {
        $ine=$reponse["INE"];
        $nom=$reponse["nomEtudiant"];
        $prenom=$reponse["prenomEtudiant"];
        $filiere=$reponse["filiere"];
        $num=$reponse["numeroTel"];

        $_SESSION['ine']=$reponse["INE"];
        $_SESSION['nomEtudiant']=$reponse["nomEtudiant"];
        $_SESSION['prenom']=$reponse["prenomEtudiant"];
        $_SESSION['AnneeEtude']=$reponse["AnneeEtude"];
        $_SESSION['filiere']=$reponse["filiere"];
        $_SESSION['ENO']=$reponse["ENO"];
        $_SESSION['bourse']=$reponse["bourse"];
        $_SESSION['handicap']=$reponse["handicap"];
        $_SESSION['num']=$reponse["numeroTel"];
        $_SESSION['numerOp']=$reponse["numeroOp"];
        $_SESSION['email']=$reponse["email"];
    }
    $requ = $bdd->prepare('SELECT idDemande,nomDemande,DateDemande,EtatDemande,lib FROM Demande where INE=:log ');
    $requ->execute(array("log"=>$_SESSION['ine']));
    $tr = $reponse["INE"].".jpg";
    $tr = "/var/www/html/photosEtudiants/".$tr;
    if(file_exists($tr)){
        $photo = $reponse["INE"].".jpg";
    }

    else{
        $photo = "defaut.jpg";
        
    }
    $test = $photo; 
    $chemin = "../../photosEtudiants/".$test;
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UVS: Remontée de Fiche</title>

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
                            <a href="#"><i class="fa fa-film" ></i> Campagnes <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#"><i class="fa fa-envelope-o"></i> Campagne SMS <span class="fa arrow"></a>
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
                            <a href="3"><i class="fa fa-mortar-board"></i> Recherche étudiant <span class="fa arrow"></span></a>
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
                        <h1 class="page-header">Remontée de Fiche</h1>
                            <div class="col-lg-12" >

                                <div class="panel panel-yellow">
                        <div class="panel-heading">
                            Informations sur l'étudiant appelant
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#profile" data-toggle="tab">Profile</a>
                                </li>
                                <li><a href="#demande" data-toggle="tab">Demandes</a>
                                </li>
                                <li><a href="#newDemande" data-toggle="tab">Nouvelle Demande</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="profile">
                                    <div class="panel-body">
                                        <img src="<?php echo $chemin;?>"  width="200" height="200"  alt="" /></br></br> 
                                        <form action="modif_profil.php" method="POST">
                          
                                            
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">INE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <input type="text" placeholder="<?php echo $_SESSION['ine'];?>" class="form-control">
                                                <input type="hidden" name="ine" value="<?php echo $_SESSION['ine'];?>" >
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Nom &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <input type="text" name="nom" value="<?php echo $_SESSION['nomEtudiant'];?>"  class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Prénom &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <input type="text" name="prenom" value="<?php echo $_SESSION['prenom'];?>"  class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon" >Année d'étude &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <input type="number" min="1" max="5" name="AnneeEtude" value="<?php echo $_SESSION['AnneeEtude'];?>"  class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon" >Filière &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <input type="text" name="filiere" value="<?php echo $_SESSION['filiere'];?>"  class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon" >ENO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <input type="text" name="ENO" value="<?php echo $_SESSION['ENO'];?>"  class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon" >Boursier(e) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <select class="form-control">
                                                    <option value="<?php echo $_SESSION['bourse'];?>"><?php if($_SESSION['bourse']==1) echo "Oui"; else echo "Non" ;?></option>
                                                    <option value="1">Oui</option>
                                                    <option value="0">Non</option>
                                                </select>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon" >Handicapé(e) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <!--input type="text" name="handicap" value="<?php echo $_SESSION['handicap'];?>"  class="form-control"-->
                                                <select class="form-control">
                                                <option value="<?php echo $_SESSION['handicap'];?>"><?php if($_SESSION['handicap']==1) echo "Oui"; else echo "Non" ;?></option>
                                                <option>Oui</option>
                                                <option>Non</option>
                                                </select>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Téléphone SIP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <input type="text" name="numTel" value="<?php echo $_SESSION['num'];?>"  class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Téléphone Portable</span>
                                                <input type="text" name="numeroOp" value="<?php echo $_SESSION['numerOp'];?>"  class="form-control">
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <input type="email" name="email" value="<?php echo $_SESSION['email'];?>"  class="form-control">
                                            </div>
                                            </br></br>  
                                            <div align="center">
                                                <button type="submit" class="btn btn-outline btn-primary">Valider</button>
                                                <button type="reset" class="btn btn-outline btn-warning"> Initialiser</button>
                                            </div>                                     
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="demande">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <img src="<?php echo $chemin;?>"  width="200" height="200"  alt="" /></br></br>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Titre</th>
                                                        <th>Date</th>
                                                        <th>Libellé</th>
                                                        <th>Etat</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $i=0;
                                                        while($reponse=$requ->fetch()){?>
                                                    <tr>
                                                          <td><?php echo $i+1; ?></td>
                                                          <td><?php echo ($reponse["nomDemande"]); ?></td>
                                                          <td><?php echo ($reponse["DateDemande"]); ?></td>
                                                          <td><?php echo ($reponse["lib"]); ?></td>
                                                          <td><?php if ($reponse["EtatDemande"]==1) {
                                                               ?>
                                                               <button type="button" class="btn btn-success">Soumis &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                               <?php
                                                                }
                                                                elseif ($reponse["EtatDemande"]==2) {
                                                               ?>
                                                               <button type="button" class="btn btn-success">En cours &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                               <?php
                                                                }
                                                                elseif ($reponse["EtatDemande"]==3) {
                                                               ?>
                                                               <button type="button" class="btn btn-success">Satisfait &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                               <?php
                                                                }
                                                                else {?>
                                                               <button type="button" class="btn btn-success">Non Satisfait</button>
                                                               <?php
                                                               
                                                                } ?>
                                                          </td>
                                                          <td><a href="modifierDemande.php?idDemande=<?php echo $reponse["idDemande"];?>" > <button class="btn btn-info btn-circle btn-lg"> <i class="fa fa-pencil"></i></button></a></td>               
                                                          <td><a href="supprimerDemande.php?idDemande=<?php echo $reponse["idDemande"];?> " >  <button class="btn btn-warning btn-circle btn-lg"> <i class="fa fa-eraser"></i></button><?php //echo ?></a></td>
                                                    </tr>
                                                    <?php 
                                                        $i++;}
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="newDemande">
                                   <div class="panel-body">
                                        <img src="<?php echo $chemin;?>"  width="200" height="200"  alt="" /></br></br>
                                        <form action="NouvelleDemande.php" method="POST">
                                            <input type="hidden" name="ine" value="<?php echo $ine;?>">
                                            <input type="hidden" name="numero" value="<?php echo $_SESSION['num'];?>">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Titre &nbsp;&nbsp;&nbsp;</span>
                                                <input type="text" name="nomDemande"   class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Date &nbsp;&nbsp;&nbsp;</span>
                                                <input type="text" name="DateDemande"   class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Etat &nbsp;&nbsp;&nbsp;</span>
                                                <!--input type="text" name="etat"   class="form-control" required-->
                                                <select name="etat" class="form-control">
                                                    <option value="1">Soumis</option>
                                                    <option value="2">En cours</option>
                                                    <option value="3">Satisfait</option>
                                                    <option value="0">Non Satisfait</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Libellé</span>
                                                <input type="text" name="lib"  class="form-control" required>
                                            </div>
                                        
                                            
                                            </br> 
                                            </br>  
                                            <div align="center">
                                            <button type="submit" class="btn btn-outline btn-primary">Valider</button>
                                            <button type="reset" class="btn btn-outline btn-warning"> Initialiser</button>
                                            </div>                                     
                                        </form >
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                                
                                <!-- /.col-lg-4 -->
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
