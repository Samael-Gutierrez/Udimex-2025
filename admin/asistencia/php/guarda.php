<?php
include("funciones.php");

session_start();
// $id_us=$_SESSION['g_id'];
$id_usuario=1;
$descripcion="Activo";
date_default_timezone_set('America/Mexico_City');
$fecha_ac = date("Y-m-d H:i:s");


r_usuario($id_usuario, $descripcion, $fecha_ac);

?>