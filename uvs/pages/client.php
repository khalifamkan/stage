<?php
include "api.php";
$rest = new RestClient();
 

$livre = $rest->setUrl('http://admin:passer@10.149.0.190:9090/plugins/restapi/v1/users')->get();
print_r($livre);

$data = array();
$data["username"]  = "Khady";
$data["password"]  = "passer";
$unLivre = json_encode( $data );
echo "\n\n\n";
//echo $unLivre;
//$rest->setUrl('http://admin:passer@10.149.0.190:9090/plugins/restapi/v1/users')->post($unLivre);

$data1 = array();
$data1["name"]  = "Groupe2";
$data1["description"]  = "groupe de TD";
$unLivre = json_encode( $data1 );

$rest->setUrl('http://admin:passer@10.149.0.190:9090/plugins/restapi/v1/groups')->post($unLivre);
 $rest->setUrl('http://admin:passer@10.149.0.190:9090/plugins/restapi/v1/users/khalifa/groups/Groupe2')->post();
 
//modification d'un livre
//$rest->setUrl('http://bibliotheque/livre/1')->put($unLivre);
 
//supression d'un livre
//$rest->setUrl('http://bibliotheque/livre/1')->delete();
?>