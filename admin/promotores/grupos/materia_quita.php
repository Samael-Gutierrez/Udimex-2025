<?php
include("../../general/consultas/basic.php");
include("../../general/consultas/materias.php");

if ($_GET){
	q_matgr2($_GET['gr'], $_GET['mt']);
} 

$red="location:materia_ver.php?id=".$_GET['gr'];
header($red);
?>

