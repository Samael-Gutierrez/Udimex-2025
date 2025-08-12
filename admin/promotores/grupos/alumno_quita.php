<?php
include("../../general/consultas/basic.php");
include("../../general/consultas/grupos.php");

if ($_GET){
	act_gru2($_GET['id'],0);
} 

$red="location:materia_ver.php?id=".$_GET['gr'];
header($red);
?>

