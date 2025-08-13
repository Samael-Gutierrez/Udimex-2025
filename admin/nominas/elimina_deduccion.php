<?php
include ("../../general/db/nominas.php");
include ("../../general/db/basica.php");

$id=$_GET["id"];
elimina_deduccion($id);

header("location:nominas.php");

?>