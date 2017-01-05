<?php 

    $test = "60";  
    $chemin = "../img/".$test.".jpg";
    //echo file_exists('../img/$test');
    if(file_exists($chemin))
        $photo = "60.jpg";
    else
        $photo = "defaut.jpg";
    echo $photo;

?>