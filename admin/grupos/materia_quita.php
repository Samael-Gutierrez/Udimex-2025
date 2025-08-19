<?php

$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/materias.php");


if ($_GET){
	q_matgr2($_GET['gr'], $_GET['mt']);
} 

$red="location:materia_ver.php?id=".$_GET['gr'];
header($red);
?>

