<?php

include("../../general/consultas/basic.php");

if($_POST){
    $tiempo = $_POST['tiempo'];
    $id = $_POST['examen'];

    cambiaTiempo($tiempo, $id);

    header('location: verExamen.php?id_portada='.$id);
}else{
    header('location: Examenes.php');
}

function cambiaTiempo($tiempo, $id){
    $consulta = "UPDATE portada SET tiempo = $tiempo WHERE id_portada = $id";
    completa($consulta);
}