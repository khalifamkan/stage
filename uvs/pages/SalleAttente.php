<?php

$q = explode(":", $_GET['h']);
$heures   = $q[0] - date("H");  // les heures < 24
$minutes  = $q[1] - date("i") ;   // les minutes  < 60
$secondes = 00;  // les secondes  < 60
$p = explode("-", $_GET['d']);
$annee = $p[0] - date("Y"); // par defaut cette année
$mois  = $p[1] - date("m");
$jour  = $p[2] - date("d");

$redirection = 'https://localhost:7443/ofmeet/?r='.$_GET['r']; // quand le compteur arrive à 0
                                            // j'ai mis une redirection


function NbJours($debut, $fin) {

  $tDeb = explode("-", $debut);
  $tFin = explode("-", $fin);

  $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) - 
          mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
  
  return(($diff / 86400)+1);

}

$Nombres_jours =  NbJours(date("Y-m-d"), $_GET['d']) - 1;

/*******************************************************************************
    * calcul des secondes
    ***************************************************************************/

$secondes = time() - mktime(date("H") + $heures,
                            date("i") + $minutes,
                            date("s") + $secondes,
                            date("m") + $mois,
                            date("d") + $jour,
                            date("Y") + $annee                            
                            );
//ne me demander pas pourquoi!! mais si vous enlever cette ligne ca ne marche pas!!
$secondes = str_replace("-","",$secondes);

?>
<script type="text/javascript">
var jr = <?php echo $Nombres_jours;?>;
var temps = <?php echo $secondes;?>;
var timer =setInterval('CompteaRebour()',1000);
function CompteaRebour(){

  temps-- ;
  j = parseInt(temps) ;
  h = parseInt(temps/3600) ;
  m = parseInt((temps%3600)/60) ;
  s = parseInt((temps%3600)%60) ;
  document.getElementById('minutes').innerHTML= 
                                                (h<10 ? "0"+h : h) + '  h :  ' +
                                                (m<10 ? "0"+m : m) + ' mn : ' +
                                                (s<10 ? "0"+s : s) + ' s ';
if ((s == 0 && m ==0 && h ==0 && jr==0)) {
   clearInterval(timer);
   url = "<?php echo $redirection;?>"
   Redirection(url)
}

}
function Redirection(url) {
setTimeout("window.location=url", 500)
}

</script>


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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>  </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i></a>
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
                            
                        </li>
                         <li>
                            
                            
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            
                        </li>
                        <li>
                            
                            
                            <!-- /.nav-second-level -->
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
                    <div class="col-lg-12" align="center"> 
                        <h1 class="page-header">Salle d'Attente</h1>
                            <div class="col-lg-6" align="center">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        Conférence
                                    </div>
                                    <div class="panel-body">
                                        <body onload="timer">
                                        <?php
                                        // le nombre de seconde soit etre superieur a 24 heures pour demarrer
                                        if ($secondes <= 3600*24) {
                                        ?>
                                        <span style="font-size: 36px;">La conférence débutera dans :</span>
                                        <div id="minutes" style="font-size: 36px;"></div></span>
                                        
                                        <?php
                                         }
                                         else {
                                        ?>
                                        <span style="font-size: 36px;">La conférence débutera dans :</span>
                                        <div  style="font-size: 36px;"><?php echo $Nombres_jours;?> jour(s)</div> </span>
                                        <?php
                                         }
                                        ?>
                                        <body>
                                    </div>
                                    <div class="panel-footer">
                                        DISI-UVS
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
        <!-- Page Content -->

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
