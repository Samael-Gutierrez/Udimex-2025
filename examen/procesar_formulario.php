<?php
include ("../general/consultas/basic.php");

$id = $_POST['usuario'];
$tema = $_POST['tema'];
date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d H:i:s');

subir($id, $tema, $fecha);

function subir($id, $tema, $fecha){
    $consulta = "INSERT INTO focus VALUES ('', $id, '$tema', '$fecha')";
    return completa($consulta);
}