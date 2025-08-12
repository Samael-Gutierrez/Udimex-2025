<?php
include ("modelo/conexion.php");

$id=$_GET["id"];
elimina_percepcion($id);

header("location:nominas.php");

?>