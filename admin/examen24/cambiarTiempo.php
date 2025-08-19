<?php
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/examenes.php");

if($_POST){
    $tiempo = $_POST['tiempo'];
    $id = $_POST['examen'];

    cambiaTiempo($tiempo, $id);

    header('location: verExamen.php?id_portada='.$id);
}else{
    header('location: Examenes.php');
}