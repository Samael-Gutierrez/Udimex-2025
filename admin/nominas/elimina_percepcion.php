<?php
include ("../../general/db/nominas.php");
include ("../../general/db/basica.php");

$id=$_GET["id"];
elimina_percepcion($id);

header("location:nominas.php");
?>