<?php
    session_start();
    require("connexion.php"); 
    $profile  = isset($_SESSION['name']) ? $_SESSION['name']:'User'; 
    $idr = isset($_POST['groupe'])?$_POST['groupe']:null;

    try{
        $bdd3 = new PDO ('mysql:host=localhost;dbname=moodledb;charset=utf8', 'mdluser','passer');
        }
    catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
        } 
    $req3=$bdd3->prepare("SELECT * FROM mdl_groups");
    $req3->execute();




    if(isset($_POST['envoyer']) && isset($_POST['groupe'])  && $_POST['groupe']!='Aucun' ){
        $r = rand();
        $msg = "Une conférence sur le thème : ".$_POST["theme"]." aura lieu le ".$_POST["date"]." à ".$_POST["heure"]."\nLe lien de la conférence: http://10.149.0.176/uvs/pages/VisioConfold.php?d=".$_POST['date']."&h=".$_POST['heure']."&r=".$r;
        $req=$bdd->prepare('insert into Conference(nom,theme,description,dateC,heure,duree,groupe) values(:nom,:theme,:description,:dateC,:heure,:duree,:groupe)');
        $req->execute(array(':nom'=>$_POST['nomConf'],':theme'=>$_POST['theme'],':description'=>$_POST['description'],':dateC'=>$_POST['date'],':heure'=>$_POST['heure'],':duree'=>$_POST['duree'],':groupe'=>$_POST['groupe'])); 
        $req->closeCursor();
        ?>  
        <script type = "text/javascript">
            res = alert('Conférence Bien enregistré');
        </script>
        <?php
        
        try{
            $bdd1 = new PDO ('mysql:host=localhost;dbname=openfire;charset=utf8', 'root','passer');
            }
        catch (Exception $e){
                    die('Erreur : ' . $e->getMessage());
            } 
        $req2=$bdd1->prepare("SELECT * FROM ofGroupUser  where groupName=:log");
        $req2->execute(array("log"=>$_POST['groupe']));
        while($reponse2=$req2->fetch()){
            $req1=$bdd1->prepare("SELECT * FROM ofUser  where username=:log");
            $req1->execute(array("log"=>$reponse2['username']));
            while($reponse1=$req1->fetch()){

                $destinataire=$reponse1['email'];
                $sujet = "Conférence-UVS";
                $message = $msg;
                $message = wordwrap($message, 70, "\r\n");
                $headers = 'From: UVS0test@gmail.com' . "\r\n" .
                 'Reply-To: UVS0test@gmail.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();
                mail($destinataire, $sujet, $message,$headers);
                }
        }
    }
    elseif(isset($_POST['envoyer']) && isset($_POST['groupeMoodle']) && $_POST['groupe']=='Aucun' ){
        $r = rand();
        $msg = "Une conférence sur le thème : ".$_POST["theme"]." aura lieu le ".$_POST["date"]." à ".$_POST["heure"]."\nLe lien de la conférence: http://10.149.0.176/uvs/pages/VisioConfold.php?d=".$_POST['date']."&h=".$_POST['heure']."&r=".$r;
        $req=$bdd->prepare('insert into Conference(nom,theme,description,dateC,heure,duree,groupe) values(:nom,:theme,:description,:dateC,:heure,:duree,:groupe)');
        $req->execute(array(':nom'=>$_POST['nomConf'],':theme'=>$_POST['theme'],':description'=>$_POST['description'],':dateC'=>$_POST['date'],':heure'=>$_POST['heure'],':duree'=>$_POST['duree'],':groupe'=>$_POST['groupeMoodle'])); 
        $req->closeCursor();
        ?>
        <script type = "text/javascript">
            res = alert('Conférence Bien enregistré');
        </script>

        <?php
        $req4=$bdd3->prepare("SELECT * FROM mdl_groups_members  where groupid=:log");
        $req4->execute(array("log"=>$_POST['groupeMoodle']));
        while($reponse4=$req4->fetch()){
            $req5=$bdd3->prepare("SELECT * FROM mdl_user  where id=:log");
            $req5->execute(array("log"=>$reponse4['userid']));
            while($reponse5=$req5->fetch()){
                $destinataire=$reponse5['email'];
                $sujet = "Conférence-UVS";
                $message = $msg;
                $message = wordwrap($message, 70, "\r\n");
                $headers = 'From: UVS0test@gmail.com' . "\r\n" .
                 'Reply-To: UVS0test@gmail.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();
                mail($destinataire, $sujet, $message,$headers);
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
                        <h1 class="page-header">Réserver une Conférence</h1>
                            <div class="col-lg-12" align="center">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        Conférence
                                    </div>
                                    <div class="panel-body">
                                        <form action="<?php  echo($_SERVER['PHP_SELF']); ?>" method="POST" id="chgfiliere">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Nom de la Conférence &nbsp;&nbsp;&nbsp;</span>
                                                <input type="text" name="nomConf" id="nomConf"  class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Théme de la Conférence </span>
                                                <input type="text" name="theme" id="theme"  class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <textarea type="text" name="description" id="description" class="form-control" required> </textarea>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Date da la Conférence &nbsp;&nbsp;&nbsp;</span>
                                                <input type="date"  name="date" id="date"  class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Heure de début &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <input type="time" name="heure" id="heure"  class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">Durée de la conférence&nbsp;&nbsp;</span>
                                                <input type="number" name="duree" min="0" id="duree"  class="form-control" required>
                                            </div>
                                            <div class="form-group input-group">
                                                <?php   $dom = new DomDocument;
                                                        $dom->load("vod.xml"); ?>
                                                <span class="input-group-addon" >Groupe &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <select name="groupe" id="groupe" onchange="document.forms['chgfiliere'].submit();" class="form-control">
                                            <?php if(isset($_POST['groupe'])){ ?>
                                                    <option><?php echo $_POST['groupe']; ?> </option>
                                                    <option>Aucun</option>
                                                <?php $listePays = $dom->getElementsByTagName('name');
                                                    foreach($listePays as $pays){
                                                ?>
                                                    <option value="<?php echo $pays->firstChild->nodeValue; ?>" >
                                                        <?php echo $pays->firstChild->nodeValue; ?>
                                                    </option>
                                                <?php } ?>
                                                <?php  } else{ ?>
                                                    <?php   $dom = new DomDocument;
                                                    $dom->load("vod.xml"); ?>
                                                    
                                                <?php $listePays = $dom->getElementsByTagName('name');
                                                                foreach($listePays as $pays){
                                                ?>
                                                    <option value="<?php echo $pays->firstChild->nodeValue; ?>" >
                                                        <?php echo $pays->firstChild->nodeValue; ?>
                                                    </option>
                                                    <?php } ?>
                                                     <option>Aucun
                                               <?php } ?>
                                                   
                                                </select>
                                            </div>
                                                <?php    if(isset($idr) && $idr != -1 && $idr == 'Aucun')
                                                 {
                                                    if(true)   
                                                    {
                                                    /* Maintenant on peut construire la liste déroulante */
                                                ?>
                                                <div class="form-group input-group">
                                                <span class="input-group-addon">Groupe Moodle&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <select name="groupeMoodle"  id="groupeMoodle" class="form-control">
                                                    <?php while($reponse3=$req3->fetch()){
                                                    ?> 
                                                    <option value="<?php echo ($reponse3["courseid"]); ?>"><?php echo ($reponse3["name"]); }?></option>
                                                </select>
                                                 
                                                <?php
                                                 
                                                }
                                                 
                                                 
                                                 
                                                }
                                                 
                                                ?>
                                            </div>
                                            </br> 
                                            </br>  
                                            <div align="center">
                                                <button type="submit" name="envoyer" value="envoyer" class="btn btn-outline btn-primary">Réserver</button>
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
