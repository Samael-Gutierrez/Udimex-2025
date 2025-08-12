<?php
include ("modelo/conexion.php");

$id=$_GET["id"];
elimina_deduccion($id);

header("location:nominas.php");

?>