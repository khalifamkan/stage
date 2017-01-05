<?php
$heuresConf = explode(":", $_GET['h']);
$dateConf = explode("-", $_GET['d']);

$datetime1 = date_create($_GET['d']);//date conférence
$datetime2 = date_create(date("Y-m-d"));//date du système;

?>

<SCRIPT LANGUAGE="JavaScript">
function disp_delai(){
    document.forms[0].elements[0].value=delai (<?php echo $dateConf[0];?>,<?php echo $dateConf[1];?>,<?php echo $dateConf[2];?>,<?php echo $heuresConf[0];?>,<?php echo $heuresConf[1];?>   );
    setTimeout("disp_delai()",1000);
    }
    
function delai(annee,mois,jour,heure,min){
    var date_fin=new Date(annee,mois-1,jour,heure,min)
    var date_jour=new Date();
    var tps=(date_fin.getTime()-date_jour.getTime())/1000;
    var j=Math.floor(tps/3600/24);      // récupere le nb de jour
    tps=tps % (3600*24);
    var h=Math.floor(tps / 3600);       // recupère le nb d'heure
    tps=tps % 3600;
    var m=Math.floor(tps/60);       // récupère le nb minute
    tps=tps % 60
    var s=Math.floor(tps);
    
    if(j<0 || h<0 || m<0 || s<0){
        var txt="Conférence terminée";
    }
    else if(j==0 && h==0 && m==0 && s==0){
        url="http://www.google.sn"
        setTimeout("window.location=url", 500)
    }
    else{
        var txt=j+" j "+h+" h "+m+" min et "+s+" sec";  
    }

    //var txt=j+" j "+h+" h "+m+" min et "+s+" sec";
    date_fin=don_date(date_fin);
    return txt;}

function don_date_jour()
    {var date_jour=new Date();
    date_jour=don_date(date_jour);
    return date_jour;}

function don_date(une_date)
    {var la_date;
    var months=new Array(12);
    months[1]="Janvier";
    months[2]="Février";
    months[3]="Mars";
    months[4]="Avril";
    months[5]="Mai";
    months[6]="Juin";
    months[7]="Juillet";
    months[8]="Aout";
    months[9]="Septembre";
    months[10]="Octobre";
    months[11]="Novembre";
    months[12]="Décembre";

    var days=new Array(7);
    days[1]="Lundi";
    days[2]="Mardi";
    days[3]="Mercredi";
    days[4]="Jeudi";
    days[5]="Vendredi";
    days[6]="Samedi";
    days[7]="Dimanche";

    var month=months[une_date.getMonth() + 1];
    var day=days[une_date.getDay()];
    var date=une_date.getDate();
    var year=une_date.getYear();
}
</SCRIPT>




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
                        <h1 class="page-header">Salle de Conférence</h1>
                            <div class="col-lg-12" align="center">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        Conférence
                                    </div>
                                    <div class="panel-body">
                                        
                                    
                                            <span style="font-size: 36px;">La conférence démarre dans :
                                            <div id="minutes" style="font-size: 36px;"></div>

                                            <body onLoad="disp_delai()">
                                            <br>
                                            <form name="mail" method=get action="">
                                              <input name="RESTE" size=25 maxlength=25>
                                            <!--iframe name="" SRC="https://ouyavirt.ec2lt.sn:7443/ofmeet/?r=h" scrolling="yes" height="220" width="180" FRAMEBORDER="yes"></iframe-->
                                            </form>
                                            </body>
                                            </span>
                                        <!--body onload="timer">
                                            <iframe src="https://localhost:7443/ofmeet/?r=h" width="900px" height="600px">
                                            </iframe>
                                        <body-->
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
